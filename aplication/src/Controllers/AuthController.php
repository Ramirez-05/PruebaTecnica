<?php

namespace Xyz\PruebaTecnica\Controllers;

use Xyz\PruebaTecnica\Models\Client;
use Xyz\PruebaTecnica\Core\JwtService;
use Exception;

class AuthController
{
    public function login($credentials)
    {
        if (empty($credentials['email']) || empty($credentials['password'])) {
            throw new Exception('El email y la contraseña son obligatorios.');
        }

        $client = Client::where('email', $credentials['email'])->first();
        
        if (!$client || !$client->verifyPassword($credentials['password'])) {
            throw new Exception('Credenciales inválidas.');
        }

        // Generar el token JWT
        $token = JwtService::generateToken($client->id);
        return ['token' => $token];
    }
}