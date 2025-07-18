<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product as Product;
use App\Category as Category;
use App\Brand as Brand;
use App\User as User;
use App\Cart as Cart;
use App\ShippingAddress;
use App\TempData;
use App\Order;
use	Illuminate\Support\Facades\Mail; 
use App\Mail\contactUs;

use Session;
use Validator;


class SiteController extends Controller
{
    public function shop(){
        $products = Product::where('status', 'Active')->paginate(20);
        return view('shop',['products'=> $products]);
    }

    public function products_by_category($category){
        $category_data = Category::where('name', $category)->first();
        $products_by_category = Product::where('category_id',$category_data->id)->where('status', 'Active')->where('sale_mode', Session::get("sale_type"))->paginate(20);
        return view('products_by_category',['products_by_category'=> $products_by_category, 'category'=> $category]);
    }

    public function products_by_brand($brand){
        $brand_data = Brand::where('name', $brand)->first();
        $products_by_brand = Product::where('brand_id', $brand_data->id)->where('status', 'Active')->where('sale_mode', Session::get("sale_type"))->paginate(20);
        return view('products_by_brand',['products_by_brand'=> $products_by_brand, 'brand'=>  $brand]);
    }
    
    public function product_details($name){
        $product = Product::where('name',$name)->first();
        return view('product-details', ['product'=> $product]);
    }

    public function add_to_cart(Request $request){
        if(!Auth::check()){
            return redirect('register-login');
        }else{
            // return $request->all();

            if($request->shopping_type == null){
                $request->shopping_type = "retail";
            }

            $data =[];
            $data['product_id'] = $request->product_id;
            $data['product_price'] = $request->product_price;
            $data['product_quantity'] = $request->product_quantity;
            $data['shopping_type'] = $request->shopping_type;
            

            $user_id = Auth::user()->id;
            
            $data['user_id'] = $user_id;

            $product_exit = Cart::where('product_id', $data['product_id'])
                                ->where('shopping_type', $data['shopping_type'])
                                ->where('user_id', Auth::user()->id)->first();

            // return response()->json($product_exit);
            // return response()->json($request->shopping_type);
            // return response()->json($product_exit->product_quantity);
            // return response()->json(json_encode($product_exit) != "null");
            // return response()->json(json_encode($product_exit) != "null" && $product_exit->shopping_type == $data['shopping_type']);

            
            if(json_encode($product_exit) != "null" && $product_exit->shopping_type == $data['shopping_type']){
                $update_quantity = $product_exit->product_quantity + $data['product_quantity'];
                $product_exit->update(['product_quantity'=>$update_quantity]);
                Session::put('msg', 'created');
                Session::put('cart', $product_exit);
                return redirect()->back();
            }else{
                $add_to_cart = Cart::create($data);
                Session::put('msg', 'created');
                Session::put('cart', $data);
                return redirect()->back();
            }
        }
    }

    public function cart(){
        $carts = Cart::where('shopping_type', Session::get("sale_type"))->where('user_id', Auth::user()->id)->get();
        // return response()->json($carts);
        return view('cart', ['carts'=> $carts]);
    // return response()->json($user);
    }

    public function shopping_setting(Request $request){
        // return response()->json($request->shopping_type);
        Session::put('sale_type', $request->shopping_type);
        // return response()->json(Session::get('shopping_type'));

        return redirect()->back();
    }

    public function update_cart(Request $request){
        $new_cart = $request->all();
        for($i=0; $i<count($new_cart['product_id']); $i++){
            Cart::where('product_id',$new_cart['product_id'][$i])
                ->where('user_id', Auth::user()->id)
                ->update(['product_quantity'=>$new_cart['product_quantity'][$i]]);
        }
        return redirect()->back();
        // return response()->json($request);
    }

    public function deleteCartItem($id){
        Cart::where('id',$id)
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $shipping = ShippingAddress::where('email', Auth::user()->email)->get();
        $carts = json_decode($request->cart);

        // return response()->json($request->all());

        // Check if cart is empty or invalid
        if (empty($carts) || count($carts) === 0) {
            return redirect()->route('cart') // ← replace 'cart.page' with your actual cart route name
                ->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        return view('checkout', ['cart' => $carts, 'shipping' => $shipping]);
    }


    public function orderConfirmation()
    {
        return view('order_confirmation');
    }

    public function checkout_handler(Request $request)
    {
        // 1. create / pick the shipping address (your existing logic) ……………………………
        $shipping_id = ShippingAddress::all()->count() + 1;
        if (!empty($request->first_name) && !empty($request->last_name)) {
            $shipping = ShippingAddress::create($request->all());
        } elseif (!empty($request->shipping_id)) {
            $shipping_id = $request->shipping_id;
            $shipping    = true;
        } else {
            return back();
        }

        // 2. pay‑on‑delivery stays unchanged ……………………………………………………………
        if($request->payment_method == "pay on delivery"){
            // …inside checkout_handler
            $totalClean = floatval(str_replace(',', '', $request->total_with_shipping));

            $data = [
                'shipping_details' => ShippingAddress::find($shipping_id),
                'order_number'     => rand(123456789, 999999999),
                'user_email'       => $request->email,
                'cart'             => $request->cart,
                'order_total'      => $totalClean,          //  ✅
                'payment_method'   => $request->payment_method,
                'status'           => 'pay on delivery',
                'sale_mode'        => Session::get('shopping_type'),
            ];
            Order::create($data);

            // ✅ Clear cart items for the user (based on email or session)
            Cart::where('user_id', auth()->id())->delete();

            // Redirect to confirmation with order number
            return redirect()->route('order.confirmation', $data['order_number']);

            // return response()->json("Order Placed!");
            
        }

        // 3. CARD / FLUTTERWAVE branch – 👉 redirect to payment.initialize
        if ($request->payment_method === 'card') {

            // Build metadata: keep it **small** – Flutterwave limits key/value sizes
            $meta = [
                'shipping_id' => $shipping_id,
                'total'       => floatval(str_replace(',', '', $request->total_with_shipping)),
                'sale_mode'   => Session::get('shopping_type'),
                'user_id'     => auth()->id(),
            ];

            // Save cart in session so the user can’t tamper with JS
            session([
                'cart_items' => $request->cart,     // still JSON string
                'payment_meta' => $meta,
            ]);

            // simple redirect (POST → Controller) so we don’t expose secrets in URL
            return redirect()->route('payment.initialize');
        }

        return back(); // fall‑through safety
    }

    public function my_account(Request $request){
        $orders = Order::where('user_email',Auth::user()->email)->get();
        $shipping_addresses = ShippingAddress::where('email',Auth::user()->email)->get();
        return view('my-account',['orders'=> $orders, 'shipping_addresses'=> $shipping_addresses]);
        // return response()->json($request);
    }

    public function register_login(Request $request){
        // return response()->json($request);
        if(Auth::user()){
            return redirect('/');
        }else{
            return view('auth');
        }
    }

    public function authenticate(Request $request){
        // return response()->json($request);

        if(isset($_POST['login'])){
            $rule = [
                'email' => 'required',
                'password' => 'required| min: 4| max: 50'
            ];

            $validate = Validator::make($request->all(), $rule);
            
            if($validate->fails()){
                return response()->json($validate->errors());
            }else{
                $login_user = Auth::attempt(['email'=> $request->email, 'password'=> $request->password]);
                // echo json_encode($login_user);
                // return response()->json($login_user);
                return redirect()->intended();
            }
            
        }else if(isset($_POST['register'])){
            $rule = [
                'email' => 'required',
                'name' => 'required| min: 6| max: 150',
                'password' => 'required| min: 4| max: 50'
            ];

            $validate = Validator::make($request->all(), $rule);
            
            if($validate->fails()){
                return response()->json($validate->errors());
            }else{
                $user = User::where('email',$request->email)->orWhere('name',$request->name)->get();
                // return response()->json(count($user));
                if(count($user) != 0){
                    // echo "email or name exits!";

                    return redirect()->back()->with('error','Error! User Already Exit');
                    // return response()->json("user exit");
                }else{
                    // echo "hello from register user";
                    $register_user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
                    // echo $login_user;
                    $login_user = Auth::attempt(['email'=> $request->email, 'password'=> $request->password]);
                    return redirect()->intended();
                    // return redirect('cart');
                    // echo json_encode($login_user);
                }
                
            }
        }

    }

    public function logout(Request $request){
        Auth::logout(); 
        return redirect()->back();
    }

    public function searchResult(Request $request){
        $search_query = $request->search_query;

        $products = Product::where('status', 'Active')
        ->where('name','like','%'.$search_query.'%')
        ->where('sale_mode', Session::get("sale_type"))->paginate(20);

        return view('search_result',['products'=> $products]);
    }

    public function contactUs(){
        return view('contact');
    }

    public function sendMessage(Request $request){
        $message_body = "Phone Number: ".$request->phone. "<br>". "Message Body: ".$request->phone;
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $message_body
        );
        if(Mail::send(new ContactUs($request->all()))){
            return redirect()->back()->with('msg','profile was successfully update!');
        }else{
            return redirect()->back()->with('error','ERROR! could not update profile!');
        }
    }

    public function orderDetails($id){
        $order = Order::find($id);
        $cart = json_decode($order->cart);
        return view('order-details',['order'=> $order, 'cart'=> $cart]);
    }

    public function editAddress($id){
        $address = ShippingAddress::find($id);
        return view('edit-address',['address'=> $address]);
    }


    public function handleEditAddress($id, Request $request){
        $address = ShippingAddress::find($id);
        $address->update($request->all());
        
        return redirect()->back()->with('msg', 'Address Changed!');
    }

    public function updateMyAccount(Request $request){
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($new_password);

        // return response()->json($data);

        if(Auth::attempt(['email'=> $data['email'], 'password'=> $current_password])){
            if($new_password == $confirm_password){
                $user = User::where('email',$data['email'])->first();
                $user->update($data);
                if(Auth::attempt(['email'=> $data['email'], 'password'=> $new_password])){
                    return redirect()->back()->with('msg', 'Success! Account Updated');
                }else{
                    return redirect()->back()->with('error', 'Error! Account Could not be Updated');
                }
                
            }else{
                return redirect()->back()->with('error', 'Error! New passwords not match');
            }
        }else{
            return redirect()->back()->with('error', 'Error! Account Does not Exist');
        }
    }
}
