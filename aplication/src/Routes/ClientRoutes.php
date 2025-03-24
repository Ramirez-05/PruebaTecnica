<?php
use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Controllers\ClientController;
use Xyz\PruebaTecnica\Middlewares\AuthMiddleware;

$clientController = new ClientController();
$authMiddleware = new AuthMiddleware();

// Rutas protegidas con autenticación
Router::group(['middleware' => [$authMiddleware]], function() use ($clientController) {
    
    // Obtener todos los clientes
    Router::get('/clients', function() use ($clientController) {
        echo json_encode($clientController->index());
    });

    // Obtener un cliente por ID
    Router::get('/clients/{id}', function($id) use ($clientController) {
        try {
            echo json_encode($clientController->show($id));
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    });

    // Crear un nuevo cliente
    Router::post('/clients', function() use ($clientController) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (isset($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            
            echo json_encode($clientController->store($data));
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    });

    // Actualizar un cliente
    Router::put('/clients/{id}', function ($id) use ($clientController) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!is_array($data)) {
                throw new Exception('Datos de entrada inválidos.');
            }
            
            $updateData = [];
            
            // Validar email si está presente
            if (isset($data['email'])) {
                $updateData['email'] = trim($data['email']); 
                
                if (!filter_var($updateData['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception('El formato del correo electrónico no es válido.');
                }
            }
            
            // Validar nombre si está presente
            if (isset($data['name'])) {
                $updateData['name'] = trim($data['name']);
                
                if (empty($updateData['name'])) {
                    throw new Exception('El nombre no puede estar vacío.');
                }
            }
            
            // Asegurarse de que al menos un campo se va a actualizar
            if (empty($updateData)) {
                throw new Exception('No se especificaron campos para actualizar.');
            }
            
            $result = $clientController->update($id, $updateData);
            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    });
    
    // Eliminar un cliente
    Router::delete('/clients/{id}', function ($id) use ($clientController) {
        try {
            $result = $clientController->destroy($id);
            echo json_encode(['success' => $result]);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    });
});