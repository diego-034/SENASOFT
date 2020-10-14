<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
    * Los atributos que serán asignados.
    *
    * @var array
    */
    protected $fillable = [
        'total', 'total_discount', 'total_iva', 'state', 'customer_id', 'user_id'
    ];
}
