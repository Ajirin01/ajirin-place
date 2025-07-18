<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;
use App\Order;
use App\Sale;
use App\Cart;
use Carbon\Carbon;
use Session;

class DashboardController extends Controller
{
    public function dashboard(){
        $sale_type = Session::get('sale_mode');
        // echo $sale_type == null;
        // exit;
        $products = Product::where('sale_mode', $sale_type)->get();

        if($sale_type == null){
            Session::put('sale_mode','retail');
        }else {
            ;
        }
        // return response()->json(Session::get('sale_type'));

        $latest_orders = Order::orderBy('id', 'desc')->take(7)->get();
        $orders = Order::all();
        // $products = Product::all();
        // $jan_sale = Sale::where();

        $latest_products = Product::orderBy('id', 'desc')->take(10)->get();

        // $sales = Sale::all();
        $carts = Cart::all();
        $users = User::where('role', 'user')->get();
        
        // sales by role
        $sales_retail = Sale::orderBy('id', 'desc')->get();
        $sales_wholesale = Sale::orderBy('id', 'desc')->get();
        // $orders = Order::where('status', 'pending')->orderBy('id', 'desc')->get();
        $sales = Sale::where('status', 'confirmed')->get();
        
        $month_sale = [];
        $months = [];
        $month_sale[0] = [];
        $month_sale[1] = [];
        $month_sale[2] = [];
        $month_sale[3] = [];
        $month_sale[4] = [];
        $month_sale[5] = [];
        $month_sale[6] = [];
        $month_sale[7] = [];
        $month_sale[8] = [];
        $month_sale[9] = [];
        $month_sale[10] = [];
        $month_sale[11] = [];
        // $month_sale[12] = [];

        // return response()->json($month_sale);
        for ($i=0; $i < count($sales); $i++) { 
            for ($j=0; $j < 12; $j++) { 
                if (Carbon::parse($sales[$i]->created_at)->month == $j+1) {
                    $total = $sales[$i]->total - $sales[$i]->discount;
                    array_push($month_sale[$j], $total);
                    array_push($months, Carbon::parse($sales[$i]->created_at)->format('M'));
                }
            }
        }

        $months_array = array_values(array_unique($months));

        // return response()->json(array_values(array_unique($months)));

        $sale_recap = [];

        for ($i=0; $i < 12; $i++) { 
            if (count($month_sale[$i]) == 0) {
                ;
            }else{
                array_push($sale_recap, ['name' => '', 'data'=> $month_sale[$i]]);
            }
            
        }

        $dis = DashboardController::getSaleTotal($sales);
        $dis_retail = DashboardController::getSaleTotal($sales_retail);
        $dis_wholesale = DashboardController::getSaleTotal($sales_wholesale);
        
        
        // return response()->json(Carbon::parse($sales[16]->created_at)->month);
        return view('Admin.dashboard',['latest_orders'=> $latest_orders,
                    'latest_products'=> $latest_products, 'products'=> $products,
                    'sales'=> $sales, 'total_orders'=> $orders,
                    'users'=> $users, 'months'=> $months_array,
                    'sales_total'=> $dis,
                    'sale_recap'=> $sale_recap,
                    'sales_retail'=> $sales_retail,
                    // 'sales_wholesale'=> $sales_wholesale,
                    'sales_total_retail'=> $dis_retail,
                    'orders'=> $orders
                    // 'sales_total_wholesale'=> $dis_wholesale
                ]);
    }

    private function getSaleTotal($sales){
        $dis = 0;
        for ($i=0; $i < count($sales); $i++) { 
            $total = $sales[$i]->total;
            $discount = $sales[$i]->discount;
            $dis = $dis + ($total - $discount);
        }

        return $dis;
    }
}
