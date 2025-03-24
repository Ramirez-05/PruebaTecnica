<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['client_id', 'created_at'];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('quantity');
    }
} 