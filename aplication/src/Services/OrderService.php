<?php

namespace Xyz\PruebaTecnica\Services;

use Xyz\PruebaTecnica\Models\Order;
use Xyz\PruebaTecnica\Models\OrderDetail;
use Xyz\PruebaTecnica\Models\Product;
use Xyz\PruebaTecnica\Models\Client;
use Illuminate\Database\Capsule\Manager as DB;
use Exception;

class OrderService
{
    /**
     * Get client by ID
     * 
     * @param int $clientId
     * @return Client|null
     */
    public function getClientById($clientId)
    {
        return Client::find($clientId);
    }
    
    /**
     * Validate product stock
     * 
     * @param int $productId
     * @param int $quantity
     * @return array
     * @throws Exception
     */
    public function validateProductStock($productId, $quantity)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            throw new Exception("El producto con ID {$productId} no existe");
        }
        
        if ($product->stock < $quantity) {
            throw new Exception("Stock insuficiente para el producto {$product->name}. Disponible: {$product->stock}");
        }
        
        return $product;
    }
    
    /**
     * Create new order with details
     * 
     * @param int $clientId
     * @param array $items Array of items with product_id and quantity
     * @return Order
     * @throws Exception
     */
    public function createOrder($clientId, $items)
    {
        if (empty($items)) {
            throw new Exception("El pedido debe contener al menos un producto");
        }
        
        $client = $this->getClientById($clientId);
        if (!$client) {
            throw new Exception("El cliente no existe");
        }
        
        $productsToOrder = [];
        foreach ($items as $item) {
            if (empty($item['product_id']) || empty($item['quantity'])) {
                throw new Exception("Todos los items deben tener product_id y quantity");
            }
            
            if ($item['quantity'] <= 0) {
                throw new Exception("La cantidad debe ser mayor a 0");
            }
            
            $product = $this->validateProductStock($item['product_id'], $item['quantity']);
            $productsToOrder[] = [
                'product' => $product,
                'quantity' => $item['quantity']
            ];
        }
        
        try {
            DB::beginTransaction();
            
            $order = new Order();
            $order->client_id = $clientId;
            $order->created_at = date('Y-m-d H:i:s');
            $order->save();
            
            foreach ($productsToOrder as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $item['product']->id;
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->save();
                
                $item['product']->stock -= $item['quantity'];
                $item['product']->save();
            }
            
            DB::commit();
            
            return $order->fresh(['details.product']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    /**
     * Get order by ID with details
     * 
     * @param int $orderId
     * @return Order
     * @throws Exception
     */
    public function getOrderById($orderId)
    {
        $order = Order::with(['details.product', 'client'])->find($orderId);
        
        if (!$order) {
            throw new Exception("El pedido no existe");
        }
        
        return $order;
    }
    
    /**
     * Get all orders for a client
     * 
     * @param int $clientId
     * @return Collection
     */
    public function getOrdersByClientId($clientId)
    {
        return Order::with('details.product')
            ->where('client_id', $clientId)
            ->get();
    }
    
    /**
     * Get all orders
     * 
     * @return Collection
     */
    public function getAllOrders()
    {
        return Order::with(['details.product', 'client'])->get();
    }
} 