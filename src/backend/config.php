<?php

class config
{
    public const items_per_page = 20;

    public const DS = DIRECTORY_SEPARATOR;
    public const WWW = "http://localhost:8080";
    public const db_dir = __DIR__ . self::DS . "data";

    public const root_dir = __DIR__;
    public const core_dir = self::root_dir . self::DS . "core";
    public const uploads_dir = self::root_dir . self::DS . "uploads";

    public const salt = "unpredictable_salt_value";

    public const dsn = "sqlite:" . self::db_dir . self::DS . "data.sqlite";

    public static function init()
    {
        if (!file_exists(self::db_dir)) {
            mkdir(self::db_dir, 0755, true);
        }
        if (!file_exists(self::uploads_dir)) {
            mkdir(self::uploads_dir, 0755, true);
        }
    }

}

config::init();
