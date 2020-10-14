<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
    * Los atributos que serán asignados.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'stock', 'description', 'price', 'image', 'iva', 'branch_id'
    ];
}
