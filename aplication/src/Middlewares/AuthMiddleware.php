<?php

namespace Xyz\PruebaTecnica\Middlewares;

use Xyz\PruebaTecnica\Core\JwtService;
use Exception;

class AuthMiddleware
{
    public function handle()
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (empty($authHeader)) {
            http_response_code(401);
            echo json_encode(['error' => 'Token de autorización no proporcionado.']);
            exit;
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $userId = JwtService::validateToken($token);
            $GLOBALS['userId'] = $userId;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }
}