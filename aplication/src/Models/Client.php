<?php

namespace Xyz\PruebaTecnica\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = ['name', 'email'];
    public $timestamps = false;
}