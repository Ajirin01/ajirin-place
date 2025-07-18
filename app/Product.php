<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'price',
        'sale_mode', 
        'image',
        'description', 
        'status',
        'size',
        'prescription',
        'wholesale',
        'wholesale_size',
        'wholesale_price',
        'wholesale_stock',
        'stock', 
        'shipping_cost',
        'sale_type',
        'brand_id',
        'category_id'
    ]; 

    public function categories(){
        return $this->belongsTo('App\Category');
    }

    public function brands(){
        return $this->belongsTo('App\Brand');
    }
    
}
