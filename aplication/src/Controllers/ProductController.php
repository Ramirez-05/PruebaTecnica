<?php

namespace Xyz\PruebaTecnica\Controllers;

use Xyz\PruebaTecnica\Services\ProductService;
use Xyz\PruebaTecnica\Services\ResponseService;
use Pecee\Http\Request;

class ProductController
{
    private $productService;
    private $responseService;
    private $request;

    /**
     * Constructor with dependency injection
     * 
     * @param ProductService $productService
     * @param ResponseService $responseService
     * @param Request $request
     */
    public function __construct(
        ProductService $productService,
        ResponseService $responseService,
        Request $request
    ) {
        $this->productService = $productService;
        $this->responseService = $responseService;
        $this->request = $request;
    }

    /**
     * Get available products for a specific client
     * 
     * @param int $clientId
     * @return void
     */
    public function getAvailableProductsForClient($clientId)
    {
        try {
            $client = $this->productService->getClientById($clientId);
            if (!$client) {
                return $this->responseService->error('Client not found', 404);
            }

            $availableProductsForClient = $this->productService->getAvailableProductsForClient($client);
            
            return $this->responseService->success($availableProductsForClient);
        } catch (\Exception $e) {
            return $this->responseService->error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
} 