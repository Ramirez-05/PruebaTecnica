<?php

require __DIR__ . '/../vendor/autoload.php';

// se carg las variables de .env 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

Xyz\PruebaTecnica\Core\Database::init();

try {
    $pdo = \Illuminate\Database\Capsule\Manager::connection()->getPdo();

    echo " ¡Conexión a la base de datos exitosa \n";
    echo "Base de datos: " . $pdo->getAttribute(\PDO::ATTR_CONNECTION_STATUS) . "\n";
}catch(\Exception $e) {
    echo " ¡Error al conectar a la base de datos \n";
    echo "Mensaje: " . $e->getMessage() . "\n";
    exit(1);
}