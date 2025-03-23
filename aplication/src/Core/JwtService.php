<?php

namespace Xyz\PruebaTecnica\Core;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtService
{
    // Generar un token JWT
    public static function generateToken($userId)
    {
        $payload = [
            'iss' => 'aplication',
            'sub' => $userId,
            'iat' => time(),     
            'exp' => time() + 3600,
        ];

        return JWT::encode($payload, self::getSecretKey(), self::getAlgorithm());
    }

    // Validar un token JWT
    public static function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(self::getSecretKey(), self::getAlgorithm()));
            return $decoded->sub;
        } catch (Exception $e) {
            throw new Exception('Token inválido o expirado.');
        }
    }

    private static function getSecretKey()
    {
        $secretKey = $_ENV['JWT_SECRET'] ?? null;

        if (!$secretKey) {
            throw new Exception('La clave secreta de JWT no está configurada.');
        }

        return $secretKey;
    }

    private static function getAlgorithm()
    {
        $algorithm = $_ENV['JWT_ALGORITHM'] ?? null;

        if (!$algorithm) {
            throw new Exception('El algoritmo de JWT no está configurado.');
        }

        return $algorithm;
    }
}