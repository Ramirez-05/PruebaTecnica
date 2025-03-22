<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

$router = new Router();

// Importar las rutas de clientes
$clientRoutes = require __DIR__ . '/ClientRoutes.php';

$clientRoutes($router);
$router->start();