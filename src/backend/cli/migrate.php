<?php

include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "config.php";

use Mc\Sql\Database;
use Mc\Filesystem\Manager;
use Mc\Filesystem\Path;
use Mc\Logger;

$logger = Logger::stdout();
$logger->info("Starting database migration...");

$database = new Database(config::dsn);

$sqlDir = Manager::Implode([dirname(__DIR__), "sql"]);
$sqlFiles = ["users.sql", "files.sql", "config.sql"];

foreach ($sqlFiles as $sqlFile) {
    $fullPath = Manager::Implode([$sqlDir, $sqlFile]);
    $path = new Path($fullPath);

    if (!$path->Exists() || !$path->IsFile()) {
        $logger->fail("SQL file not found: " . (string)$path);
        exit(1);
    }

    $logger->info("Applying SQL dump: {$sqlFile}");
    $database->parseSqlDump((string)$path);
    $logger->pass("Applied: {$sqlFile}");
}

$database->close();
$logger->pass("Database schema migration completed successfully.");
