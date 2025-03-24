<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'stock'];
    public $timestamps = false; 

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_product', 'product_id', 'client_id');
    }

    public function isAvailable()
    {
        return $this->stock > 0;
    }
} 