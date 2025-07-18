<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempData extends Model
{
    protected $fillable = [
        'total_price',
        'cart',
        'shipping_id',
        'user_email'
    ];
}
