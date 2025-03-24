<?php

namespace Xyz\PruebaTecnica\Core;

class ServiceContainer
{
    private static $instance;
    private $services = [];
    
    /**
     * Private constructor for singleton pattern
     */
    private function __construct() {}
    
    /**
     * Get singleton instance
     * 
     * @return ServiceContainer
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    /**
     * Register a service in the container
     * 
     * @param string $name
     * @param callable $factory
     * @return void
     */
    public function register($name, $factory)
    {
        $this->services[$name] = [
            'factory' => $factory,
            'instance' => null
        ];
    }
    
    /**
     * Get a service from the container
     * 
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function get($name)
    {
        if (!isset($this->services[$name])) {
            throw new \Exception("Service '{$name}' not found in container");
        }
        
        if (null === $this->services[$name]['instance']) {
            $factory = $this->services[$name]['factory'];
            $this->services[$name]['instance'] = $factory();
        }
        
        return $this->services[$name]['instance'];
    }
} 