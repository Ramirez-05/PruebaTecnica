<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Core\ServiceConfig;
use Xyz\PruebaTecnica\Middlewares\AuthMiddleware;

Router::group(['prefix' => '/orders', 'middleware' => [AuthMiddleware::class]], function() {
    
    Router::get('/', function() {
        $controller = ServiceConfig::getController('order_controller');
        return $controller->index();
    });

    Router::get('/{id}', function($id) {
        $controller = ServiceConfig::getController('order_controller');
        return $controller->show($id);
    });
    
    Router::get('/client/{clientId}', function($clientId) {
        $controller = ServiceConfig::getController('order_controller');
        return $controller->getByClient($clientId);
    });

    Router::post('/', function() {
        $controller = ServiceConfig::getController('order_controller');
        return $controller->create();
    });
}); 