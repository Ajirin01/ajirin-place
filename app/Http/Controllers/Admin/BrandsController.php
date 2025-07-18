<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand as Brand;
use Validator;
use Session;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('Admin.Brands.brand_list', ['brands'=> $brands]);
    }

    public function create()
    {
        return view('Admin.Brands.brand_creation_form');
    }

    public function store(Request $request)
    {
        $rule = [
            'name'=> 'required| min:3| max: 191',
            'status'=> 'required',
        ];
        $data = array();
        $data['name'] = $request->name;
        $data['sale_mode'] = Session::get('sale_type');
        
        if($request->status == "on"){
            $data['status'] = "Active";
        }else{
            $data['status'] = "Inactive";
        }
        $valid = Validator::make($request->all(),$rule);

        if($valid->fails()){
            // return response()->json($valid->errors());
            return redirect()->back()->with('errors',$valid->errors());
        }else{
            $create_brand = Brand::create($data);

            if($create_brand){
                return redirect()->back()->with('success','record created!');
            }else{
                return redirect()->back()->with('errors','could not create record');
            }
        }
        // return response()->json($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $brand_to_edit = Brand::find($id);
        return view('Admin.Brands.brand_edit_form', ['brand_id'=>$id, 'brand'=>$brand_to_edit]);
    }

    public function update(Request $request, $id)
    {
        $brand_to_update = Brand::find($id);

        $update_brand = $brand_to_update->update(['name'=> $request->name,'status'=> $request->status === "on" ? "active" : "inactive"]);

        if($update_brand){
            return redirect()->back()->with('success', 'Brand successfully updated!');
        }else {
            return redirect()->back()->with('errors', 'Brand could not successfully updated!');

        }
        // return response()->json($request->all());
    }

    public function destroy($id)
    {
        $brand_to_delete = Brand::find($id);

        $delete_brand = $brand_to_delete->delete();

        if($delete_brand){
            return redirect()->back()->with('success', 'Brand successfully deleted!');
        }else {
            return redirect()->back()->with('errors', 'Brand could not successfully deleted!');

        }
        // return response()->json($id);
    }
}
