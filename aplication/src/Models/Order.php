<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_pedido';
    protected $fillable = ['id_cliente', 'created_at'];
    public $timestamps = false;
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_cliente');
    }
    
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'id_pedido');
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'id_pedido', 'id_producto')
            ->withPivot('quantity');
    }
} 