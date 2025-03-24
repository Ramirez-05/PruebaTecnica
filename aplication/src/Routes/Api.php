<?php
use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Middlewares\CorsMiddleware;
use Xyz\PruebaTecnica\Core\ServiceConfig;

$router = new Router();
$cors = new CorsMiddleware();

ServiceConfig::registerServices();

Router::options('{all}', function() use ($cors) {
    $cors->handle(Router::router()->getRequest());
})->where(['all' => '.*']);

Router::group(['middleware' => [$cors]], function() {
    require __DIR__ . '/AuthRoutes.php';
    require __DIR__ . '/ClientRoutes.php';
    require __DIR__ . '/ProductRoutes.php';
    require __DIR__ . '/OrderRoutes.php';
});

$router->error(function() use ($cors) {
    $cors->handle(Router::router()->getRequest());
    http_response_code(404);
    echo json_encode(['error' => 'Ruta no encontrada']);
});

$router->start();