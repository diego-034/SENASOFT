<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
    * Los atributos que serán asignados.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'lastname', 'address', 'document', 'phone', 'email', 'branch_id'
    ];
}