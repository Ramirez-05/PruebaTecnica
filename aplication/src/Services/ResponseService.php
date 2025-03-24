<?php

namespace Xyz\PruebaTecnica\Services;

use Pecee\Http\Response;

class ResponseService
{
    private $response;
    
    public function __construct()
    {
        $this->response = new Response();
    }
    
    /**
     * Return success response
     * 
     * @param mixed $data
     * @param int $statusCode
     * @return void
     */
    public function success($data, $statusCode = 200)
    {
        $this->response->httpCode($statusCode)->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    
    /**
     * Return error response
     * 
     * @param string $message
     * @param int $statusCode
     * @return void
     */
    public function error($message, $statusCode = 500)
    {
        $this->response->httpCode($statusCode)->json([
            'status' => 'error',
            'message' => $message
        ]);
    }
} 