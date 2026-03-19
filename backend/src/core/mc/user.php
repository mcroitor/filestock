<?php

namespace Mc;

use Mc\Sql\Database;

class User
{
    public static function Register(array $data): bool
    {
        $email = trim($data['email']);
        $password = trim($data['password']);

        $data = [
            "username" => trim($data['username'] ?? ''),
            "seed" => bin2hex(random_bytes(16)), // Generate a unique seed for the user
            "email" => hash("sha256", $email), // Store a hash of the email for privacy
            "password" => password_hash($password, PASSWORD_DEFAULT), // Hash the password for security
            "role" => $data['role'] ?? 'user',
            "created_at" => date("Y-m-d H:i:s")

        ];
        $db = new Database(\config::DSN);

        $existingUser = $db->select("users", ["password"], ["email" => $data['email']]);

        if (!empty($existingUser)) {
            return false; // User already exists
        }

        $db->insert("users", $data);

        return true;
    }
}
