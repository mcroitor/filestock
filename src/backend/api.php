<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . "config.php";

use Mc\Module;
use Mc\Router;

Router::init();

Module::loadAll(__DIR__ . DIRECTORY_SEPARATOR . 'extensions');

echo Router::run();