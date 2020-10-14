<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     /**
    * Los atributos que serán asignados.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'content', 'branch_id'
    ];
}
