<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id_order_detail';
    protected $fillable = ['id_pedido', 'id_producto', 'quantity'];
    public $timestamps = false;
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_pedido');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }
} 