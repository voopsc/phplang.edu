<?php

    // 1. General settings
    ini_set('display_errors', 1);
    ini_set('date.timezone', 'Europe/Kiev');
    error_reporting(E_ALL);

    // 2. Project main settings
    define('ROOT', __DIR__);
    include_once(ROOT . '/core/components/Autoload.php');

    // 3. Routing
    $router = New Router;
    $router->run();
