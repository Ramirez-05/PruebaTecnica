<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = false; 

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'client_product', 'client_id', 'product_id');
    }
}