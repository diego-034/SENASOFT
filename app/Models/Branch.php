<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
    * Los atributos que serán asignados.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'address', 'phone', 'store_id'
    ];
}
