<?php
use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Core\ServiceConfig;

Router::post('/login', function() {
    $controller = ServiceConfig::getController('auth_controller');
    return $controller->login();
});