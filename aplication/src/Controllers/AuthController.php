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
            // Obtener datos del request
            $data = json_decode(file_get_contents('php://ut'), true);
            
            // Validar campos obligatorios
            if (empty($data['email']) || empty($data['password'])) {
                http_response_code(400);
                return ['error' => 'Email y contraseña son obligatorios'];
            }

            // Buscar cliente
            $client = Client::where('email', $data['email'])->first();
            
            if (!$client || !$client->verifyPassword($data['password'])) {
                http_response_code(401);
                return ['error' => 'Credenciales inválidas'];
            }

            // Generar y retornar token
            return [
                'token' => JwtService::generateToken($client->id),
                'user_id' => $client->id
            ];

        } catch (Exception $e) {
            http_response_code(500);
            return ['error' => 'Error en el servidor: ' . $e->getMessage()];
        }
    }
}