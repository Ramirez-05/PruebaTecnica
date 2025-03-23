<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

$router = new Router();

// Importar las rutas de autenticación
$authRoutes = require __DIR__ . '/AuthRoutes.php';
$authRoutes($router);

// Importar las rutas de clientes
$clientRoutes = require __DIR__ . '/ClientRoutes.php';
$clientRoutes($router);

// Ejecutar el middleware antes de procesar la ruta
$router->setCallback(function ($route) {
    $middleware = $route->getMiddleware();
    if ($middleware) {
        $middleware->handle();
    }
    $route->getCallback()();
});

$router->start();