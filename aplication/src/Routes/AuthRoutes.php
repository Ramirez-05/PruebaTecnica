<?php

use Xyz\PruebaTecnica\Controllers\AuthController;

$authController = new AuthController();

return function ($router) use ($authController) {
    // Ruta para el login
    $router->post('/login', function () use ($authController) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($authController->login($data));
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    });
};