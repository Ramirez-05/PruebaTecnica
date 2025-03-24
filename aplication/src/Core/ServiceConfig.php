<?php

namespace Xyz\PruebaTecnica\Core;

use Xyz\PruebaTecnica\Services\ProductService;
use Xyz\PruebaTecnica\Services\ResponseService;
use Xyz\PruebaTecnica\Services\AuthService;
use Xyz\PruebaTecnica\Services\ClientService;
use Xyz\PruebaTecnica\Services\OrderService;
use Pecee\Http\Request;
use Xyz\PruebaTecnica\Controllers\ProductController;
use Xyz\PruebaTecnica\Controllers\AuthController;
use Xyz\PruebaTecnica\Controllers\ClientController;
use Xyz\PruebaTecnica\Controllers\OrderController;

class ServiceConfig
{
    /**
     * Register all application services
     * 
     * @return void
     */
    public static function registerServices()
    {
        $container = ServiceContainer::getInstance();
        
        $container->register('request', function() {
            return new Request();
        });
        
        $container->register('product_service', function() {
            return new ProductService();
        });
        
        $container->register('response_service', function() {
            return new ResponseService();
        });
        
        $container->register('auth_service', function() {
            return new AuthService();
        });
        
        $container->register('client_service', function() {
            return new ClientService();
        });
        
        $container->register('order_service', function() {
            return new OrderService();
        });
        
        $container->register('product_controller', function() use ($container) {
            return new ProductController(
                $container->get('product_service'),
                $container->get('response_service'),
                $container->get('request')
            );
        });
        
        $container->register('auth_controller', function() use ($container) {
            return new AuthController(
                $container->get('auth_service'),
                $container->get('response_service')
            );
        });
        
        $container->register('client_controller', function() use ($container) {
            return new ClientController(
                $container->get('client_service'),
                $container->get('response_service')
            );
        });
        
        $container->register('order_controller', function() use ($container) {
            return new OrderController(
                $container->get('order_service'),
                $container->get('response_service'),
                $container->get('request')
            );
        });
    }
    
    /**
     * Get a controller instance
     * 
     * @param string $name
     * @return mixed
     */
    public static function getController($name)
    {
        return ServiceContainer::getInstance()->get($name);
    }
} 