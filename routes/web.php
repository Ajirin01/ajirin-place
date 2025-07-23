<?php
Route::get('/', function () {
    if(Session::get('shopping_type') == "wholesale"){
        $hot_sales = App\Product::where('sale_type','hot_sale')->where('wholesale', 'on')->take(10)->get();
        $hot_deals = App\Product::where('sale_type','hot_deal')->where('wholesale', 'on')->take(10)->get();
        $new_arrival = App\Product::where('sale_type','new_arrival')->where('wholesale', 'on')->take(10)->get();
        $latest_product = App\Product::where('status', 'Active')->where('wholesale', 'on')->orderBy('id', 'desc')->take(10)->get();
    }else{
        $hot_sales = App\Product::where('sale_type','hot_sale')->take(10)->get();
        $hot_deals = App\Product::where('sale_type','hot_deal')->take(10)->get();
        $new_arrival = App\Product::where('sale_type','new_arrival')->take(10)->get();
        $latest_product = App\Product::where('status', 'Active')->orderBy('id', 'desc')->take(10)->get();
    }
    
    return view('home',['hot_sales'=>$hot_sales, 
                        'hot_deals'=>$hot_deals, 
                        'new_arrival'=>$new_arrival, 
                        'latest_products'=>$latest_product,]);
});

Auth::routes();

Route::get('/home', function(){
    return redirect('/');
})->name('home');

Route::get('product-detials/{product}', 'SiteController@product_details')->name('product-details');
Route::post('add-to-cart/', 'SiteController@add_to_cart')->name('add-to-cart')->middleware('auth');
Route::get('cart/', 'SiteController@cart')->name('cart')->middleware('auth');
Route::post('update-cart', 'SiteController@update_cart')->name('update-cart')->middleware('auth');
Route::get('delete-cart-item/{item}', 'SiteController@deleteCartItem')->name('delete_cart_item')->middleware('auth');
Route::get('checkout/', 'SiteController@checkout')->name('checkout')->middleware('auth');
Route::get('search/', 'SiteController@searchResult')->name('search-results');
Route::get('contact-us/', 'SiteController@contactUs')->name('contact-us');
Route::post('contact-send/', 'SiteController@sendMessage')->name('sendMessage');
Route::post('contact-us/', 'SiteController@checkout')->name('contact-handler');
Route::post('checkout-handler', 'SiteController@checkout_handler')->name('checkout-handler')->middleware('auth');
Route::get('my-acount/', 'SiteController@my_account')->name('my-account')->middleware('auth');
Route::get('register-login/', 'SiteController@register_login')->name('register-login');
Route::post('authenticate/', 'SiteController@authenticate')->name('authenticate');
Route::get('shop/', 'SiteController@shop')->name('shop');
Route::get('products-by-category/{category}', 'SiteController@products_by_category')->name('products-by-category');
Route::get('products-by-brand/{brand}', 'SiteController@products_by_brand')->name('products-by-brand');
Route::post('shopping-setting/', 'SiteController@shopping_setting')->name('shopping-setting');
Route::post('logout/', 'SiteController@logout')->name('logout');
Route::get('order-details/{id}', 'SiteController@orderDetails')->name('order-details')->middleware('auth');
Route::post('update-my-account/', 'SiteController@updateMyAccount')->name('update-my-account')->middleware('auth');
Route::get('/order/confirmation/{orderNumber}', 'SiteController@orderConfirmation')->name('order.confirmation');

Route::post('/checkout',  'SiteController@checkout_handler')->name('checkout-handler');
Route::get('/pay',        'PaymentController@initialize')->name('payment.initialize');
Route::get('/payment/callback', 'PaymentController@callback')->name('payment.callback');
Route::get('/order/confirmation/{orderNumber}', 'SiteController@orderConfirmation')->name('order.confirmation');


Route::get('edit-address/{id}', 'SiteController@editAddress')->name('edit-address')->middleware('auth');
Route::put('hanle-edit-address/{id}', 'SiteController@handleEditAddress')->name('handle-edit-address')->middleware('auth');

Route::get('/pre-order', 'PreOrderController@create')->name('preorder.create');
Route::post('/pre-order', 'PreOrderController@store')->name('preorder.store');
Route::get('/pre-order/thank-you/{code}', 'PreOrderController@thankYou')->name('preorder.thankyou');
Route::get('/pre-order/invoice/{code}', 'PreOrderController@invoice')->name('preorder.invoice');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard')->middleware('admin');
    Route::resource('products',	'Admin\ProductsController')->middleware('product');
    Route::get('products-bulk-edit',	'Admin\ProductsController@productBulkEditCreate')->middleware('product')->name('product-bulk-edit');
    Route::post('products-bulk-edit-minna',	'Admin\ProductsController@productBulkEditStoreMinna')->middleware('product')->name('product-bulk-edit-minna');
    Route::post('products-bulk-edit-asaba',	'Admin\ProductsController@productBulkEditStoreAsaba')->middleware('product')->name('product-bulk-edit-asaba');
    Route::get('order/{type}',	'Admin\OrdersController@getOrdersByType')->name('orders_by_type')->middleware('order');
    Route::get('order-details/{order}',	'Admin\OrdersController@orderDetails')->name('order_details')->middleware('order');
    Route::post('update_order_status/{order}', 'Admin\OrdersController@updateOrderStatus')->name('update_order_status')->middleware('order');
    Route::resource('brands',	'Admin\BrandsController')->middleware('product');
    Route::resource('users',	'Admin\UsersController')->middleware('admin');
    Route::resource('categories',	'Admin\CategoriesController')->middleware('product');
    Route::get('admin-login', 'Admin\AuthController@loginForm')->name('admin-login');
    Route::post('admin-login-handle', 'Admin\AuthController@login')->name('login');


    // Admin Pre-Orders
    Route::get('preorders', 'Admin\PreOrderController@index')->name('admin.preorders.index')->middleware('admin');
    Route::get('preorders/create', 'Admin\PreOrderController@create')->name('admin.preorders.create')->middleware('admin');
    Route::delete('preorders/{id}', 'Admin\PreOrderController@destroy')->name('admin.preorders.delete')->middleware('admin');
    Route::get('preorders/{id}', 'Admin\PreOrderController@show')->name('admin.preorders.show')->middleware('admin');
    Route::get('preorders/edit/{id}', 'Admin\PreOrderController@edit')->name('admin.preorders.edit')->middleware('admin');
    Route::post('preorders', 'Admin\PreOrderController@store')->name('admin.preorders.store')->middleware('admin');
    Route::put('preorders/update/{id}', 'Admin\PreOrderController@update')->name('admin.preorders.update')->middleware('admin');


    Route::post('admin-logut', function(){
        Auth::logout();
        return redirect()->route('admin-login');
    })->name('admin-logout');
}); 

Route::prefix('pos')->group(function () {
    Route::get('sale', 'Admin\DashboardController@dashboard')->name('sale')->middleware('sale')->middleware('shopAssist');
    Route::post('add_products', 'Admin\Pos\SalesController@addProductsToSell')->name('add_product_to_sell')->middleware('sale')->middleware('shopAssist');
    Route::post('update_cart', 'Admin\Pos\SalesController@updateCart')->name('update_cart')->middleware('sale')->middleware('shopAssist');
    Route::post('process_sale', 'Admin\Pos\SalesController@processSale')->name('process_sale')->middleware('sale')->middleware('shopAssist');
    Route::resource('sales',	'Admin\Pos\SalesController')->middleware('sale')->middleware('shopAssist');
}); 

Route::get('sep_sale_mode', function(){
    // instantiate product model object
    $Product = new App\Product;

     // instantiate sale model object
     $Sale = new App\Sale;

    // change sale mode to wholesale where wholesale is ON and also make retail price wholesale price
    $Product::where('wholesale', 'on')->update(['sale_mode'=> 'wholesale', 'wholesale_price'=> DB::raw('products.price')]);

    // change sale mode to retail where wholesale is OFF
    $Product::where('wholesale', 'off')->update(['sale_mode'=> 'retail']);

    // change sale type to wholesale where sale_type is empty(null)
    $Sale::where('sale_type', '')->update(['sale_type'=> 'wholesale']);

    // return response()->json($Product::where('wholesale', 'off')->get());
    return response()->json($Product::all());
});
