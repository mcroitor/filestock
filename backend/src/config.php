<?php

spl_autoload_register(function (string $class) {
    $prefix = "Mc\\";
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "mc" . DIRECTORY_SEPARATOR;
    $relativeClass = substr($class, strlen($prefix));
    $normalizedPath = str_replace("\\", DIRECTORY_SEPARATOR, $relativeClass);

    $candidates = [
        $baseDir . $normalizedPath . ".php",
        $baseDir . strtolower($normalizedPath) . ".php",
    ];

    foreach ($candidates as $file) {
        if (is_file($file)) {
            require_once $file;
            return;
        }
    }
});

class config
{
    public const DS = DIRECTORY_SEPARATOR;
    public const WWW = "http://localhost:8080";
    public const DB_DIR = __DIR__ . self::DS . "db";

    public const ROOT_DIR = __DIR__;
    public const CORE_DIR = self::ROOT_DIR . self::DS . "core";

    public const SALT = "unpredictable_salt_value";

    public const DSN = "sqlite:" . self::DB_DIR . self::DS . "files.db";

    public static int $items_per_page = 20;

    public static array $env = [];

    public static function loadEnv(): void
    {
        $envFile = __DIR__ . self::DS . ".env";
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                if (strpos($line, '=') === false) continue;
                list($key, $value) = explode('=', $line, 2);
                self::$env[trim($key)] = trim($value);
            }
        }
    }

    public static function getEnv(string $key, string $default = ''): string
    {
        return self::$env[$key] ?? $default;
    }

    public static function init(): void
    {
        self::loadEnv();
        self::initDatabase();
    }

    private static function initDatabase(): void
    {
        $dbFile = self::DB_DIR . self::DS . "files.db";
        
        if (!file_exists($dbFile)) {
            $initSql = self::DB_DIR . self::DS . "init.sql";
            if (file_exists($initSql)) {
                $db = new \Mc\Sql\Database(self::DSN);
                $db->parseSqlDump($initSql);
            }
        }
        
        self::createAdminIfNotExists();
    }

    private static function createAdminIfNotExists(): void
    {
        $adminData = [
            "username" => "admin",
            "email" => self::getEnv('ADMIN_USER', 'admin@local.host'),
            "password" => self::getEnv('ADMIN_PASSWORD', 'admin123'),
            "role" => "admin"
        ];
        
        if (empty($adminData['email']) || empty($adminData['password'])) {
            return;
        }
        
        \Mc\User::Register($adminData);
    }

}

config::init();
