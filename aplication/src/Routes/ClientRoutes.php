<?php

use Xyz\PruebaTecnica\Controllers\ClientController;
use Xyz\PruebaTecnica\Middlewares\AuthMiddleware;

$clientController = new ClientController();
$authMiddleware = new AuthMiddleware();

return function ($router) use ($clientController, $authMiddleware) {
    
    $router->group(['middleware' => $authMiddleware], function () use ($router, $clientController) {

        // Obtener todos los clientes
        $router->get('/clients', function () use ($clientController) {
            echo json_encode($clientController->index());
        });

        // Obtener un cliente por ID
        $router->get('/clients/{id}', function ($id) use ($clientController) {
            try {
                echo json_encode($clientController->show($id));
            } catch (Exception $e) {
                http_response_code(404);
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        // Crear un nuevo cliente
        $router->post('/clients', function () use ($clientController) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($clientController->store($data));
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        // Actualizar un cliente
        $router->put('/clients/{id}', function ($id) use ($clientController) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($clientController->update($id, $data));
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['error' => $e->getMessage()]);
            }
        });

        // Eliminar un cliente
        $router->delete('/clients/{id}', function ($id) use ($clientController) {
            try {
                echo json_encode($clientController->destroy($id));
            } catch (Exception $e) {
                http_response_code(404);
                echo json_encode(['error' => $e->getMessage()]);
            }
        });
    });
};