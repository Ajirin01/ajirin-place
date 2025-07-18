<?php

namespace App\Http\Controllers\Admin\Pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductsController extends Controller
{
    public function getProducts(){
        $products = Product::all();
        return view('Admin.Products.product_list',['products' => $products]);
    }
}
