<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); 
$dotenv->load();

Xyz\PruebaTecnica\Core\Database::init();

require __DIR__ . '/../src/Routes/Api.php'; 