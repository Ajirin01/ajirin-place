<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category as Category;
use Validator;
use Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Admin.Categories.category_list', ['categories'=> $categories]);
    }
    
    public function create()
    {
        return view('Admin.Categories.category_creation_form');

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
            $create_category = Category::create($data);

            if($create_category){
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
        $category = Category::find($id);
        return view('Admin.Categories.category_edit_form',['category'=> $category]);
        
    }
    
    public function update(Request $request, $id)
    {
        // $category_name = Category::where('name', $request->name)->
        $category_to_update = Category::find($id);

        $update_category = $category_to_update->update([$request->name]);

        if($update_category){
            return redirect()->back()->with('success', 'Category successfully updated!');
        }else {
            return redirect()->back()->with('errors', 'Category could not successfully updated!');

        }
        // return response()->json($request->all());
    }

    public function destroy($id)
    {
        $category_to_delete = Category::find($id);

        $delete_category = $category_to_delete->delete();

        if($delete_category){
            return redirect()->back()->with('success', 'Category successfully deleted!');
        }else {
            return redirect()->back()->with('errors', 'Category could not successfully deleted!');

        }
        // return response()->json($id);
    }
}
