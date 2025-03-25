<?php

namespace Xyz\PruebaTecnica\Services;

use Xyz\PruebaTecnica\Models\Client;
use Xyz\PruebaTecnica\Core\JwtService;
use Illuminate\Database\Capsule\Manager as DB;
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

        try {
            $pdo = DB::connection()->getPdo();
            $stmt = $pdo->prepare("SELECT id_cliente, email, password, name FROM clients WHERE email = ?");
            $stmt->execute([$data['email']]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$user) {
                throw new Exception('Credenciales inválidas - Usuario no encontrado');
            }
            
            if (!password_verify($data['password'], $user['password'])) {
                throw new Exception('Credenciales inválidas - Contraseña incorrecta');
            }
            
            $userId = (int)$user['id_cliente'];
            if ($userId <= 0) {
                throw new Exception('Error de ID: ' . json_encode($user));
            }
            
            return [
                'token' => JwtService::generateToken($userId),
                'user_id' => $userId
            ];
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'Credenciales inválidas') === 0 ||
                strpos($e->getMessage(), 'Error de ID') === 0) {
                throw $e;
            }
            throw new Exception('Error en la autenticación: ' . $e->getMessage());
        }
    }
} 