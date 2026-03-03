<?php

namespace Mc;

use Mc\Sql\Database;

class User
{
    private static array $user = [];

    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            self::$user = $_SESSION['user'];
        }
    }

    public static function register(string $email, string $password, ?string $username = null): array
    {
        self::init();

        $normalizedEmail = self::normalizeEmail($email);
        self::ensurePassword($password);
        $emailHash = self::emailHash($normalizedEmail);

        $database = new Database(\config::dsn);

        try {
            if ($database->exists('users', ['email_hash' => $emailHash])) {
                throw new \DomainException('user_exists');
            }

            $userId = $database->insert('users', [
                'email_hash' => $emailHash,
                'username' => self::normalizeUsername($username),
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'role' => Role::USER,
                'language' => 'en'
            ]);

            if ($userId === false) {
                throw new \RuntimeException('register_failed');
            }

            $rows = $database->select('users', ['*'], ['id' => (int) $userId], Database::LIMIT1);
            if (empty($rows)) {
                throw new \RuntimeException('register_failed');
            }

            return self::toPublicUser($rows[0]);
        } finally {
            $database->close();
        }
    }

    public static function login(string $email, string $password): array
    {
        self::init();

        $normalizedEmail = self::normalizeEmail($email);
        self::ensurePassword($password);
        $emailHash = self::emailHash($normalizedEmail);

        $database = new Database(\config::dsn);

        try {
            $rows = $database->select('users', ['*'], [
                'email_hash' => $emailHash
            ], Database::LIMIT1);
            if (empty($rows)) {
                throw new \UnexpectedValueException('invalid_credentials');
            }

            $user = $rows[0];
            $passwordHash = (string) ($user['password_hash'] ?? '');
            if ($passwordHash === '' || !password_verify($password, $passwordHash)) {
                throw new \UnexpectedValueException('invalid_credentials');
            }

            $publicUser = self::toPublicUser($user);

            session_regenerate_id(true);
            $_SESSION['user'] = $publicUser;
            self::$user = $publicUser;

            return $publicUser;
        } finally {
            $database->close();
        }
    }

    public static function logout(): void
    {
        self::init();

        self::$user = [];
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                [
                    'expires'  => time() - 3600,
                    'path'     => $params['path'],
                    'domain'   => $params['domain'],
                    'secure'   => (bool) $params['secure'],
                    'httponly' => (bool) $params['httponly'],
                    'samesite' => 'Lax',
                ]
            );
        }

        session_destroy();
    }

    private static function normalizeEmail(string $email): string
    {
        $normalized = trim(mb_strtolower($email));
        if ($normalized === '' || filter_var($normalized, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('invalid_email');
        }
        return $normalized;
    }

    private static function ensurePassword(string $password): void
    {
        $normalized = trim($password);
        if ($normalized === '' || mb_strlen($normalized) < 8) {
            throw new \InvalidArgumentException('invalid_password');
        }
    }

    private static function normalizeUsername(?string $username): ?string
    {
        if ($username === null) {
            return null;
        }

        $normalized = trim($username);
        return $normalized === '' ? null : $normalized;
    }

    private static function emailHash(string $email): string
    {
        return hash_hmac('sha256', $email, \config::salt);
    }

    private static function toPublicUser(array $user): array
    {
        $id = (int) ($user['id'] ?? 0);

        return [
            'id' => $id,
            'email_hash' => (string) ($user['email_hash'] ?? ''),
            'username' => self::resolveUsername($user, $id),
            'role' => (string) ($user['role'] ?? Role::USER),
            'language' => (string) ($user['language'] ?? 'en'),
            'created_at' => (string) ($user['created_at'] ?? '')
        ];
    }

    private static function resolveUsername(array $user, int $id): string
    {
        $username = trim((string) ($user['username'] ?? ''));
        if ($username !== '') {
            return $username;
        }

        return 'anonymous_' . $id;
    }
}
