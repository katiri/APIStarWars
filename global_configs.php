<?php
    require 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    if($_ENV['SSL'] === 'true'){
        $http = 'https://';
    }
    else{
        $http = 'http://';
    }
    
    $BASE_URL = $http . $_SERVER["SERVER_NAME"] . dirname(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']) . "?");
    $BASE_URL = rtrim($BASE_URL, '/') . '/';

    $API_URL = $_ENV['API_URL'];

    date_default_timezone_set('America/Sao_Paulo');