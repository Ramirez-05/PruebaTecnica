<?php

namespace Xyz\PruebaTecnica\Controllers;

use Xyz\PruebaTecnica\Models\Client;
use Xyz\PruebaTecnica\Core\JwtService;
use Exception;

class AuthController
{
    public function login()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (empty($data['email']) || empty($data['password'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Email y contraseña son obligatorios']);
                return;
            }

            $client = Client::where('email', $data['email'])->first();
            
            if (!$client || !$client->verifyPassword($data['password'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Credenciales inválidas']);
                return;
            }
            echo json_encode([
                'token' => JwtService::generateToken($client->id),
                'user_id' => $client->id
            ]);
            return;

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en el servidor: ' . $e->getMessage()]);
            return;
        }
    }
}