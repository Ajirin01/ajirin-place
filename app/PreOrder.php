<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'product_details', 'invoice_code', 'estimated_cost', 'status'];
}
