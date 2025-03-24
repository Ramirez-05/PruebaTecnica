<?php

namespace Xyz\PruebaTecnica\Controllers;

use Xyz\PruebaTecnica\Services\OrderService;
use Xyz\PruebaTecnica\Services\ResponseService;
use Pecee\Http\Request;
use Exception;

class OrderController
{
    private $orderService;
    private $responseService;
    private $request;

    /**
     * Constructor with dependency injection
     * 
     * @param OrderService $orderService
     * @param ResponseService $responseService
     * @param Request $request
     */
    public function __construct(
        OrderService $orderService,
        ResponseService $responseService,
        Request $request
    ) {
        $this->orderService = $orderService;
        $this->responseService = $responseService;
        $this->request = $request;
    }

    /**
     * Create a new order
     * 
     * @return void
     */
    public function create()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (empty($data['client_id'])) {
                return $this->responseService->error('El client_id es obligatorio', 400);
            }
            
            if (empty($data['items']) || !is_array($data['items'])) {
                return $this->responseService->error('Se requiere un array de items', 400);
            }
            
            $order = $this->orderService->createOrder($data['client_id'], $data['items']);
            
            return $this->responseService->success($order, 201);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 
                strpos($e->getMessage(), 'Stock insuficiente') !== false ? 400 : 500
            );
        }
    }

    /**
     * Get order by ID
     * 
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        try {
            $order = $this->orderService->getOrderById($id);
            
            return $this->responseService->success($order);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 404);
        }
    }

    /**
     * Get all orders for a client
     * 
     * @param int $clientId
     * @return void
     */
    public function getByClient($clientId)
    {
        try {
            $orders = $this->orderService->getOrdersByClientId($clientId);
            
            return $this->responseService->success($orders);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 500);
        }
    }

    /**
     * Get all orders
     * 
     * @return void
     */
    public function index()
    {
        try {
            $orders = $this->orderService->getAllOrders();
            
            return $this->responseService->success($orders);
        } catch (Exception $e) {
            return $this->responseService->error($e->getMessage(), 500);
        }
    }
} 