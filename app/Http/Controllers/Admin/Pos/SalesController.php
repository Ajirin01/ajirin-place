<?php

namespace App\Http\Controllers\Admin\Pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Sale;
use App\Product;
use Session;

class SalesController extends Controller
{
    function sale_number(){

        $year          = date("Y");
        $month         = date("m");
        $sales         = Sale::count();
        $sale_number   = $year.$month."-".($sales+1);

        return $sale_number;

    }  

    public function index()
    {
        $sales = Sale::where('sale_mode', Session::get('sale_mode'))->orderBy('id', 'desc')->get();

        // return response()->json($sales);
        return view('Admin.Pos.sales_list',['sales' => $sales]);
    }

    public function create()
    {
        $sale_number = $this->sale_number();
        $products = Product::where('sale_mode', Session::get('sale_mode'))->where('status','active')->get();
        
        return view('Admin.Pos.add_product_to_sell',['products' => $products, 'sale_number'=> $sale_number]);
    }

    public function store(Request $request)
    {   
        return response()->json(Session::get('sale_mode'));
        return response()->json($request->all());
    }

    public function show($id)
    {
        $sale = Sale::find($id);

        $sale_cart = json_decode($sale->cart);
        // return response()->json($sale);

        
        return view('Admin.Pos.sale_details',['sale' => $sale, 'sale_cart'=> $sale_cart]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $status = $request->status;

        $sale_to_update = Sale::find($id);

        $update_sale = $sale_to_update->update(['status'=> $status]);

        // $all_sales = Sale::all();

        // return response()->json($all_sales->sum('total'));
        if($update_sale){
            return redirect()->back()->with('success', 'Sale successfully updated!');
        }else {
            return redirect()->back()->with('success', 'Sale could not successfully updated!');
        }
    }

    public function destroy($id)
    {
        // return response()->json($id);
        $sale_to_delete = Sale::find($id);
        $delete_sale = $sale_to_delete->delete();

        if($delete_sale){
            return redirect()->back()->with('success', 'Sale deleted');
        }else {
            return redirect()->back()->with('errors', 'Error! Sale could not be deleted');
        }
    }

    public function addProductsToSell(Request $request){
        $added_product = $request->all();

        $added_product = $request->cart;
        // return response()->json($added_product);


        // return response()->json(json_decode($added_product['cart'])[0]);

        $cart = array();
        $total = 0;

        for($i=0; $i<count(json_decode($added_product)); $i++){
            array_push($cart,['product_id'=> json_decode($added_product)[$i]->product_id,
                        'product_name'=> json_decode($added_product)[$i]->product_name,
                        'product_price'=> json_decode($added_product)[$i]->product_price,
                        'product_quantity'=> json_decode($added_product)[$i]->product_quantity
                        ]);

            $total += json_decode($added_product)[$i]->product_price * json_decode($added_product)[$i]->product_quantity;
        }

        // return response()->json($cart);
        
        // return response()->json($total);
        Session::put('cart', $cart);
        return view('Admin.Pos.added_products',['products' => $cart, 'total'=> $total, 'sale_number'=> $this->sale_number()]);
    }

    public function updateCart(Request $request){
        $added_product = $request->all();

        // return response()->json($added_product);

        $cart = array();
        $total = 0;
        
        for($i=0; $i<count($added_product['product_name']); $i++){
            array_push($cart,['product_id'=> $added_product['product_id'][$i],
                        'product_name'=> $added_product['product_name'][$i],
                        'product_price'=> $added_product['product_price'][$i],
                        'product_quantity'=> $added_product['product_quantity'][$i]
                        ]);

            $total = $total + $added_product['product_price'][$i] * $added_product['product_quantity'][$i];
        }
        
        return view('Admin.Pos.added_products',['products' => $cart, 'total'=> $total, 'sale_number'=> $this->sale_number()]);
    }

    public function processSale(Request $request){
        $data = $request->all();
        
        $data['sale_rep'] = Auth::user()->name;
        $data['status'] = 'confirmed';
        $data['sale_mode'] = Session::get('sale_mode');

        $create_sale = Sale::create($data);

        if($create_sale){
            foreach (json_decode($request->cart) as $cart) {
                if(Session::get('sale_mode') == 'wholesale'){ 
                    $product = Product::find($cart->product_id);
    
                    $initial_stock = explode(' ',$product->wholesale_stock)[0];
                    $new_stock = $initial_stock - $cart->product_quantity;
                    
                    $product->update(['wholesale_stock'=> $new_stock]);
                }else{
                    $product = Product::find($cart->product_id);
    
                    $initial_stock = $product->stock;
                    $new_stock = $initial_stock - $cart->product_quantity;
                    
                    $product->update(['stock'=> $new_stock]);
                }
            }
            // return response()->json($data);
            return view('Admin.Pos.receipt', ['sale'=> $data]);
            // return redirect('retail/sales/create');
        }else{
            return redirect()->back();
        }
    }
}
