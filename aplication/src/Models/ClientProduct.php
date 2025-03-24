<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProduct extends Model
{
    protected $table = 'client_product';
    protected $fillable = ['client_id', 'product_id'];
    public $timestamps = false;
} 