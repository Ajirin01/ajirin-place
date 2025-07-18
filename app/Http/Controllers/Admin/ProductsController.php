<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product as Product;
use App\Brand as Brand;
use App\Category as Category;
use Validator;
use Session;

class ProductsController extends Controller
{
    public function index()
    {
        // $products = Product::where('sale_mode', Session::get('sale_type'))->get();
        $products = Product::all();
        return view('Admin.Products.product_list',['products' => $products]);
    }
    
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();

        if(Session::get('branch') == 'asaba' || Session::get('sale_type') == 'retail'){
            $view = 'Admin.Products.asaba_product_creation_form';
        }else if(Session::get('branch') == 'minna' || Session::get('sale_type') == 'wholesale'){
            $view = 'Admin.Products.minna_product_creation_form';
        }

        return view($view, ['brands'=> $brands, 'categories'=> $categories]);
    }
    
    public function store(Request $request)
    {
        // return response()->json($request->all());

        if(Session::get('branch') == 'minna' || Session::get('sale_type') == 'wholesale'){
            $rule = [
                'category_id'=> 'required',
                'brand_id'=> 'required',
                'name'=> 'required| min:3| max: 191',
                'description'=> 'required| min: 5| max: 1000',
                'wholesale_price'=> 'required',
                'wholesale_stock'=> 'required',
                'wholesale_size'=> 'required',
                'wholesale_stock_quantity'=> 'required',
                'wholesale_quantity'=> 'required'
            ];
            
        }else if(Session::get('branch') == 'asaba' || Session::get('sale_type') == 'retail'){
            $rule = [
                'category_id'=> 'required',
                'brand_id'=> 'required',
                'name'=> 'required| min:3| max: 191',
                'price'=> 'required| integer',
                'size'=> 'required',
                'description'=> 'required| min: 5| max: 1000',
                'stock'=> 'required| integer'
            ];
        }

        $valid = Validator::make($request->all(),$rule);

        if($valid->fails()){
            // return response()->json($valid->errors());
            return redirect()->back()->withInput($request->all())->with('errors',$valid->errors());
        }else{
            $brand = Brand::where('name', $request->brand)->first();
            $category = Category::where('name', $request->category)->first();

            $data = $request->all();

            if($request->status == "on"){
                $data['status'] = "Active";
            }else{
                $data['status'] = "Inactive";
            }

            $data['size'] = $request->size." ".$request->retail_quantity;
            $data['prescription'] = false;
            if($request->wholesale == "on"){
                $data['wholesale'] = $request->wholesale;
                $data['wholesale_size'] = $request->wholesale_size." ".$request->wholesale_quantity;
                $data['wholesale_price'] = $request->wholesale_price;
                $data['wholesale_stock'] = $request->wholesale_stock." ".$request->wholesale_stock_quantity;
            }
            $data['sale_mode'] = Session::get('sale_type');

            if($request->hasFile('image')){
                $image_file = $request->file('image');
                $image_exe = $image_file->getClientOriginalExtension();
                $image_name = rand(123456789,999999999).'.'.$image_exe;
                $upload_path = public_path('uploads/');
                
                
                $data['image'] = $image_name;

                $product_exit = Product::where('name', $request->name)->first();
                if(!empty($product_exit)){
                    return redirect()->back()->with('error', 'product name already exists');
                }
                $create_product = Product::create($data);

                if($create_product){
                    $image_file->move($upload_path, $image_name);
                    return redirect()->back()->with('success','record created!');
                }else{
                    return redirect()->back();
                }
            }else{
                $product_exit = Product::where('name', $request->name)->first();
                if(!empty($product_exit)){
                    return redirect()->back()->with('error', 'product name already exists');
                }
                $data['image'] = "no-image.png";

                $create_product = Product::create($data);

                if($create_product){
                    return redirect()->back()->with('success','record created!');
                }else{
                    return redirect()->back();
                }
            }
        }
    }
    
    public function show($id)
    {
        return response()->json("product details");
    }

    public function edit($id)
    {
        // return response()->json("product edit form");
        $categories = Category::all();
        $product = Product::find($id);
        $brands = Brand::all();

        $brand = Brand::find($product->brand_id);
        $category = Category::find($product->category_id);

        // return response()->json($category);
        // echo json_encode($brand);
        // exit;

        if(Session::get('branch') == 'asaba' || Session::get('sale_type') == 'retail'){
            $view = 'Admin.Products.asaba_product_edit_form';
        }else if(Session::get('branch') == 'minna' || Session::get('sale_type') == 'wholesale'){
            $view = 'Admin.Products.minna_product_edit_form';
        }

        return view($view,['product'=> $product, 
        'categories'=> $categories, 'brands'=> $brands, 'category'=> $category, 'brand'=> $brand]);
    }

    public function update(Request $request, $id)
    {
        // return response()->json("product update handler");
        // return response()->json($request->all());

        $rule = [
            'category'=> 'required',
            'brand'=> 'required',
            'name'=> 'required| min:3| max: 191',
            'description'=> 'required| min: 5| max: 1000',
        ];
        
        $valid = Validator::make($request->all(),$rule);

        $brand = Brand::find($request->brand_id);
        $category = Category::find($request->category_id);

        $data = $request->all();

        if($request->status == "on"){
            $data['status'] = "active";
        }else{
            $data['status'] = "inactive";
        }
        
        if($valid->fails()){
            // return response()->json($valid->errors());
            return redirect()->back()->with('errors',$valid->errors());
        }else{
            if($request->hasFile('image')){
                $image_file = $request->file('image');
                $image_exe = $image_file->getClientOriginalExtension();
                $image_name = rand(123456789,999999999).'.'.$image_exe;
                $upload_path = public_path('uploads/');
                
                $data['image'] = $image_name;

                $product_to_update = Product::find($id);

                $update_product = $product_to_update->update($data);
                $product_to_update->image = $image_name;

                if($update_product){
                    $image_file->move($upload_path, $image_name);
                    return redirect()->back()->with('success','Product updated!');
                }else{
                    return redirect()->back()->with('errors','Could not update product');
                }
            }else{
                $product_to_update = Product::find($id);

                $update_product = $product_to_update->update($data);
                return redirect()->back()->with('success','Product updated!');
            }
        }
    }
    
    public function destroy($id)
    {
        // return response()->json("product delete handler");
        $product_to_delete = Product::find($id);

        $delete_product = $product_to_delete->delete();

        if($product_to_delete){
            return redirect()->back()->with('success', 'Product deleted!');
        }else{
            return redirect()->back()->with('errors', 'Product could not delete successfully!');
        }return redirect()->back()->with('success', 'Product deleted!');
    }


    public function productBulkEditCreate(){
        
        if(Session::get('branch') == 'asaba' || Session::get('sale_type') == 'retail'){
            $products = Product::where('sale_mode', 'retail')->get();
            $view = 'Admin.Products.asaba_product_bulk_edit_form';
        }else if(Session::get('branch') == 'minna' || Session::get('sale_type') == 'wholesale'){
            $products = Product::where('sale_mode', 'wholesale')->get();
            $view = 'Admin.Products.minna_product_bulk_edit_form';
        }

        return view($view, ['products'=> $products]);
    }

    public function productBulkEditStoreAsaba(Request $request){
        $loop_count = count($request->checked);

        for ($i=0; $i < $loop_count; $i++) { 
            if($request->checked[$i] === "on"){
                if($request->action === 'update'){
                    Product::where('id', $request->id[$i])->update(['price'=> $request->price[$i], 'stock'=> $request->stock[$i], 'status'=> $request->status[$i]]);
                }else{
                    Product::where('id', $request->id[$i])->delete();
                }
            }
        }
        
        return redirect()->back()->with('success', 'products successfully' . ($request->action === 'update' ? ' updated' : ' deleted'));
    }

    public function productBulkEditStoreMinna(Request $request){
        // return response()->json($request->all());
        $loop_count = count($request->checked);

        for ($i=0; $i < $loop_count; $i++) { 
            if($request->checked[$i] === "on"){
                if($request->action === 'update'){
                    $stock = $request->wholesale_stock[$i] . " " . $request->wholesale_stock_quantity[$i];
                    Product::where('id', $request->id[$i])->update(['wholesale_price'=> $request->wholesale_price[$i], 'wholesale_stock'=> $stock, 'status'=> $request->status[$i]]);
                }else{
                    Product::where('id', $request->id[$i])->delete();
                }
            }
        }

        return redirect()->back()->with('success', 'products successfully' . ($request->action === 'update' ? ' updated' : ' deleted'));
    }
}
