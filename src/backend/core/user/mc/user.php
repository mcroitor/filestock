<?php

namespace Mc;

class User
{
    private static array $user;

    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
