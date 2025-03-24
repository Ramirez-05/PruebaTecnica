<?php

namespace Xyz\PruebaTecnica\Controllers;

use Xyz\PruebaTecnica\Services\ClientService;
use Xyz\PruebaTecnica\Services\ResponseService;
use Exception;

class ClientController
{
    private $clientService;
    private $responseService;

    /**
     * Constructor with dependency injection
     * 
     * @param ClientService $clientService
     * @param ResponseService $responseService
     */
    public function __construct(
        ClientService $clientService,
        ResponseService $responseService
    ) {
        $this->clientService = $clientService;
        $this->responseService = $responseService;
    }

    /**
     * Create a new client
     * 
     * @return void
     */
    public function create()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            $client = $this->clientService->store($data);
            
            return $this->responseService->success($client, 201);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 400);
        }
    }

    /**
     * Get a client by ID
     * 
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        try {
            $client = $this->clientService->show($id);
            
            return $this->responseService->success($client);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 404);
        }
    }

    /**
     * Get all clients
     * 
     * @return void
     */
    public function index() 
    {
        try {
            $clients = $this->clientService->index();
            
            return $this->responseService->success($clients);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 500);
        }
    }

    /**
     * Update a client
     * 
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            $client = $this->clientService->update($id, $data);
            
            return $this->responseService->success($client);
        } catch (Exception $e) {
            $statusCode = 500;
            
            if (str_contains($e->getMessage(), 'no encontrado')) {
                $statusCode = 404;
            } elseif (str_contains($e->getMessage(), 'ya está registrado') || str_contains($e->getMessage(), 'obligatorio')) {
                $statusCode = 400;
            }
            
            return $this->responseService->error($e->getMessage(), $statusCode);
        }
    }

    /**
     * Delete a client
     * 
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $result = $this->clientService->destroy($id);
            
            return $this->responseService->success(['message' => 'Cliente eliminado correctamente']);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 
                str_contains($e->getMessage(), 'no encontrado') ? 404 : 500
            );
        }
    }
}