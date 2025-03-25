<?php
use Pecee\SimpleRouter\SimpleRouter as Router;
use Xyz\PruebaTecnica\Core\ServiceConfig;
use Xyz\PruebaTecnica\Middlewares\AuthMiddleware;

$authMiddleware = new AuthMiddleware();

Router::group(['middleware' => [$authMiddleware]], function() {
    
    Router::get('/clients', function() {
        $controller = ServiceConfig::getController('client_controller');
        echo json_encode($controller->index());
    });

    Router::get('/clients/{id}', function($id) {
        try {
            $controller = ServiceConfig::getController('client_controller');
            echo json_encode($controller->show($id));
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    });

    Router::post('/clients', function() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (isset($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            
            $controller = ServiceConfig::getController('client_controller');
            echo json_encode($controller->store($data));
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    });

    Router::put('/clients/{id}', function ($id) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!is_array($data)) {
                throw new Exception('Datos de entrada inválidos.');
            }
            
            $updateData = [];
            
            if (isset($data['email'])) {
                $updateData['email'] = trim($data['email']); 
                
                if (!filter_var($updateData['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception('El formato del correo electrónico no es válido.');
                }
            }
            
            if (isset($data['name'])) {
                $updateData['name'] = trim($data['name']);
                
                if (empty($updateData['name'])) {
                    throw new Exception('El nombre no puede estar vacío.');
                }
            }
            
            if (empty($updateData)) {
                throw new Exception('No se especificaron campos para actualizar.');
            }
            
            $controller = ServiceConfig::getController('client_controller');
            $result = $controller->update($id, $updateData);
            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    });

    Router::delete('/clients/{id}', function ($id) {
        try {
            $controller = ServiceConfig::getController('client_controller');
            $result = $controller->destroy($id);
            echo json_encode(['success' => $result]);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        }
    });
});