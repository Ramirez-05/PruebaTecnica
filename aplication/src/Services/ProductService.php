<?php

namespace Xyz\PruebaTecnica\Services;

use Xyz\PruebaTecnica\Models\Product;
use Xyz\PruebaTecnica\Models\Client;

class ProductService
{
    /**
     * Get client by ID
     * 
     * @param int $clientId
     * @return Client|null
     */
    public function getClientById($clientId)
    {
        return Client::where('id_cliente', $clientId)->first();
    }
    
    /**
     * Get available products for a client
     * 
     * @param Client $client
     * @return array
     */
    public function getAvailableProductsForClient(Client $client)
    {
        $availableProducts = Product::where('stock', '>', 0)->get();
        
        $clientProducts = $client->products()->pluck('products.id_producto')->toArray();
        
        return $availableProducts->filter(function($product) use ($clientProducts) {
            return !in_array($product->id_producto, $clientProducts);
        })->values();
    }
} 