<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'total',
        'cart',
        'sale_number',
        'payment_method',
        'status',
        'discount',
        'sale_mode'
    ];
}
