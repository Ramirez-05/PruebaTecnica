<?php
use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Controllers\AuthController;

$authController = new AuthController();

Router::post('/login', function() use ($authController) {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($authController->login($data));
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
    }
});