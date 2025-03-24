<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Core\ServiceConfig;
use Xyz\PruebaTecnica\Middlewares\AuthMiddleware;

ServiceConfig::registerServices();

Router::group(['prefix' => '/api/products', 'middleware' => [AuthMiddleware::class]], function() {
    
    Router::get('/available/client/{id}', function($id) {
        $controller = ServiceConfig::getController('product_controller');   
        return $controller->getAvailableProductsForClient($id);
    });
}); 