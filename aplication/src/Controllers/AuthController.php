<?php

namespace Xyz\PruebaTecnica\Controllers;

use Xyz\PruebaTecnica\Services\AuthService;
use Xyz\PruebaTecnica\Services\ResponseService;
use Exception;

class AuthController
{
    private $authService;
    private $responseService;

    /**
     * Constructor with dependency injection
     * 
     * @param AuthService $authService
     * @param ResponseService $responseService
     */
    public function __construct(
        AuthService $authService,
        ResponseService $responseService
    ) {
        $this->authService = $authService;
        $this->responseService = $responseService;
    }

    /**
     * Login user and generate token
     * 
     * @return void
     */
    public function login()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            $result = $this->authService->login($data);
            
            return $this->responseService->success($result);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 
                $e->getMessage() === 'Credenciales inválidas' ? 401 : 
                    ($e->getMessage() === 'Email y contraseña son obligatorios' ? 400 : 500)
            );
        }
    }
}