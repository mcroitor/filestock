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

    private static array $coreClassMap = [];

    public static function init()
    {
        self::initAutoload();

        if (!file_exists(self::db_dir)) {
            mkdir(self::db_dir, 0755, true);
        }
        if (!file_exists(self::uploads_dir)) {
            mkdir(self::uploads_dir, 0755, true);
        }
    }

    private static function initAutoload(): void
    {
        spl_autoload_register(function (string $className): void {
            if (empty(self::$coreClassMap)) {
                self::$coreClassMap = self::buildCoreClassMap();
            }

            $separatorPosition = strrpos($className, "\\");
            $shortClassName = $separatorPosition === false
                ? $className
                : substr($className, $separatorPosition + 1);

            $shortClassKey = strtolower($shortClassName);
            if (isset(self::$coreClassMap[$shortClassKey])) {
                include_once self::$coreClassMap[$shortClassKey];
            }
        });
    }

    private static function buildCoreClassMap(): array
    {
        $result = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::core_dir, FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }

            if (strtolower($fileInfo->getExtension()) !== "php") {
                continue;
            }

            $classKey = strtolower($fileInfo->getBasename(".php"));
            if (!isset($result[$classKey])) {
                $result[$classKey] = $fileInfo->getPathname();
            }
        }

        return $result;
    }

}

config::init();
