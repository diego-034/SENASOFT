<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    /**
    * Los atributos que serán asignados.
    *
    * @var array
    */
    protected $fillable = [
        'quantity', 'total', 'discount', 'iva', 'state', 'product_id', 'invoice_id'
    ];
}
