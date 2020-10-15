<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_TEMP = -1;

    /**
     * Los atributos que serán asignados.
     *
     * @var array
     */
    protected $fillable = [
        'total', 'total_discount', 'total_iva', 'state', 'customer_id', 'user_id'
    ];
}
