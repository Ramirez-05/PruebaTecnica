<?php
namespace Xyz\PruebaTecnica\Middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class CorsMiddleware implements IMiddleware {
    public function handle(Request $request): void {
        $this->setCorsHeaders();
    }
    
    public function setCorsHeaders(): void {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Content-Type: application/json');
    }
}