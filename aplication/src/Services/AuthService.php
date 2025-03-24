<?php

namespace Xyz\PruebaTecnica\Services;

use Xyz\PruebaTecnica\Models\Client;
use Xyz\PruebaTecnica\Core\JwtService;
use Exception;

class AuthService
{
    /**
     * Validate login credentials and return token
     * 
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function login($data)
    {
        if (empty($data['email']) || empty($data['password'])) {
            throw new Exception('Email y contraseña son obligatorios');
        }

        $client = Client::where('email', $data['email'])->first();
        
        if (!$client || !$client->verifyPassword($data['password'])) {
            throw new Exception('Credenciales inválidas');
        }

        return [
            'token' => JwtService::generateToken($client->id),
            'user_id' => $client->id
        ];
    }
} 