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
            $order->id_cliente = $clientId;
            $order->created_at = date('Y-m-d H:i:s');
            $order->save();
            
            foreach ($productsToOrder as $item) {
                $product = DB::table('products')
                    ->where('id_producto', $item['product']->id_producto)
                    ->lockForUpdate()
                    ->first();
                
                if ($product->stock < $item['quantity']) {
                    throw new Exception("Stock insuficiente para el producto ID: {$item['product']->id_producto}");
                }
                
                $orderDetail = new OrderDetail();
                $orderDetail->id_pedido = $order->id_pedido;
                $orderDetail->id_producto = $item['product']->id_producto;
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->save();
                
                DB::table('products')
                    ->where('id_producto', $item['product']->id_producto)
                    ->update(['stock' => $product->stock - $item['quantity']]);
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
            ->where('id_cliente', $clientId)
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
    
    public function getOrdersByClient($clientId)
    {
        return DB::table('orders as o')
            ->select(DB::raw('o.*, GROUP_CONCAT(CONCAT(p.nombre, " (", od.quantity, ")") SEPARATOR ", ") as productos'))
            ->leftJoin('order_details as od', 'o.id_pedido', '=', 'od.id_pedido')
            ->leftJoin('products as p', 'od.id_producto', '=', 'p.id_producto')
            ->where('o.id_cliente', $clientId)
            ->groupBy('o.id_pedido')
            ->orderByDesc('o.created_at')
            ->get();
    }
} 