<?php
use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Middlewares\CorsMiddleware;

// Configuración inicial
$router = new Router();
$cors = new CorsMiddleware();

// Manejar OPTIONS para CORS
Router::options('{all}', function() use ($cors) {
    $cors->handle(Router::router()->getRequest());
})->where(['all' => '.*']);

// Agrupar todas las rutas con el middleware CORS
Router::group(['middleware' => [$cors]], function() {
    require __DIR__ . '/AuthRoutes.php';
    require __DIR__ . '/ClientRoutes.php';
});

// Manejo de errores
$router->error(function() use ($cors) {
    $cors->handle(Router::router()->getRequest());
    http_response_code(404);
    echo json_encode(['error' => 'Ruta no encontrada']);
});

// Iniciar router
$router->start();