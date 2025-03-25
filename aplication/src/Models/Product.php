<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['name', 'stock'];
    public $timestamps = false; 

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_product', 'id_producto', 'id_cliente');
    }

    public function isAvailable()
    {
        return $this->stock > 0;
    }
} 