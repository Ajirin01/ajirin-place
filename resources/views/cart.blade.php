@extends('layouts.site_base')
@section('content')
    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="pro-thumbnail">Thumbnail</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-quantity">Quantity</th>
                                <th class="pro-subtotal">Sub Total</th>
                                <th class="pro-remove">Select / Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                                <form id="update-cart" action="{{ route('update-cart') }}" method="post">
                                    @csrf
                                    @foreach ($carts as $cart)
                                        <tr>
                                            @php
                                                $product = App\Product::find($cart->product_id);
                                                
                                                // return response()->json($cart);
                                                // $product = json_decode($product);
                                            @endphp
                                            <td class="pro-thumbnail">
                                                <a href="{{ route('product-details', $product->name) }}"><img class="img-fluid" src="{{asset('public/uploads/'.$product->image)}}"
                                                                                        alt="Product"/></a></td>
                                            <td class="pro-title">{{$product->name}}({{$cart->shopping_type}})<a href="{{ route('product-details', $product->name) }}">
                                                
                                            </a></td>
                                            <td class="pro-price"><span>₦{{ number_format($cart->product_price) }}</span></td>
                                            <td class="pro-quantity">
                                                <div class="pro-qty"><input name="product_quantity[]" id="product-quantity{{$cart->id}}" type="text" value="{{$cart->product_quantity}}"></div>
                                            </td>
                                            <input type="hidden" id="product-id{{$cart->id}}" name="product_id[]" value="{{$cart->product_id}}">
                                            <input type="hidden" id="shopping-type{{$cart->id}}" name="shopping_type[]" value="{{$cart->shopping_type}}">
                                            <input type="hidden" id="product-price{{$cart->id}}"  value="{{$product->price}}">
                                            <input type="hidden" id="shipping-price{{$cart->id}}"  value="{{$product->shipping_cost}}">
                                            <input type="hidden" id="cart-id{{$cart->id}}"  value="{{$cart->id}}">
                                            <input type="hidden" id="product-name{{$cart->id}}"  value="{{$product->name}}">
                                            

                                            <td class="pro-subtotal"><span>₦{{ number_format($cart->product_quantity * $cart->product_price) }}</span></td>



                                            <td class="pro-remove">
                                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                                    <input type="checkbox" name="add_to_checkout" id="add-to-checkout{{$cart->id}}" onclick="return addToCheckout({{$cart->id}})">
                                                    <a href="{{ route('delete_cart_item', $cart->id) }}" style="margin-left: 10px;">
                                                        <i class="fa fa-trash-o" style="color: red;"></i>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">
                        <div class="apply-coupon-wrapper">
                            <form action="#" method="post" class=" d-block d-md-flex">
                                <!-- <input type="text" placeholder="Enter Your Coupon Code" required />
                                <button class="sqr-btn">Apply Coupon</button> -->
                            </form>
                        </div>
                        <div class="cart-update mt-sm-16">
                            <a href="{{ route('update-cart') }}" class="sqr-btn"
                                onclick="event.preventDefault()
                                document.getElementById('update-cart').submit()
                                "
                            >Update Cart</a>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-lg-5 ml-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h3>Checkout Totals</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    {{-- <tr>
                                        <td>Sub Total</td>
                                        @php
                                            $subtotal = 0;
                                            $shipping = 0;
                                            for($i=0; $i< count($carts); $i++){
                                                $subtotal += $carts[$i]->product_price * $carts[$i]->product_quantity;
                                                $shipping = $shipping + App\Product::find($carts[$i]->product_id)->shipping_cost;
                                            }
                                        @endphp
                                        <td>#{{($subtotal)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>#{{($shipping)}}</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">#{{ $subtotal + $shipping }}</td>
                                    </tr> --}}

                                    <tr>
                                        <td>Sub Total</td>
                                        <td>₦ <span id="subtotal">0</span></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>₦ <span id="shipping">0</span></td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">₦<span id="total">0</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <form id="cart-form" action="{{ route('checkout') }}" method="GET">
                            @csrf
                            <input type="hidden" name="cart" id="cart">
                        </form>
                        <a href="{{ route('checkout') }}" id="checkout-btn" class="sqr-btn d-block"
                        onclick="event.preventDefault();
                        document.getElementById('cart-form').submit();
                        "
                        >Proceed To Checkout</a>
                        <a href="{{ route('checkout') }}" id="checkout-add-btn" class="sqr-btn d-block"
                        onclick="event.preventDefault()"
                        >Checkout Empty, Please Check Products to Checkout!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
<script>
    // $(document).ready(function(){
    //     document.getElementById("category-toggle").click()
    // })
    var subtotal = document.getElementById('subtotal')
    var total = document.getElementById('total')
    var shipping = document.getElementById('shipping')
    var cart_array = document.getElementById('cart')

    var checkout_button = document.getElementById('checkout-btn')
    var add_checkout_button = document.getElementById('checkout-add-btn')
    

    var total_array = []

    console.log(total.innerText == 0)
    if(total.innerText == 0){
        checkout_button.style.opacity = 0
        add_checkout_button.style.opacity = 1
    }else{
        checkout_button.style.opacity = 1
        add_checkout_button.style.opacity = 0
    }

    function addToCheckout(id){
        var cart_id = document.getElementById('cart-id'+id)
        var product_id = document.getElementById('product-id'+id)
        var product_quantity = document.getElementById('product-quantity'+id)
        var product_price = document.getElementById('product-price'+id)
        var shopping_type = document.getElementById('shopping-type'+id)
        var shipping_price = document.getElementById('shipping-price'+id)
        // console.log('before product name')
        
        var product_name = document.getElementById('product-name'+id)
        
        var total_counter = 0
        var subtotal_counter = 0
        var shipping_counter = 0
        
        var add_to_checkout = document.getElementById('add-to-checkout'+id)

        var cart = {
                    'cart_id': cart_id.value,
                    'product_id': product_id.value,
                    'product_quantity': product_quantity.value,
                    'product_price': product_price.value,
                    'shopping_type': shopping_type.value,
                    'shipping_price': shipping_price.value,
                    'subtotal': product_price.value*product_quantity.value
                }

        if(add_to_checkout.checked == true){
            // console.log(add_to_checkout.value)
            total_array = [...total_array, cart]
            console.log(total_array)
            // add_to_checkout.checked == false
            product_id.name = "product_id[]"
            product_price.name = "product_price[]"
            product_name.name = "product_name[]"
            product_quantity.name = "product_quantity[]"

            subtotal.innerText = " "
            shipping.innerText = " "
            total.innerText = " "

            total_array.forEach(ele => {
            subtotal_counter += Number(ele.product_price*ele.product_quantity)
            shipping_counter += Number(ele.shipping_price)
            total_counter += Number(ele.product_price*ele.product_quantity)
            });
            

            subtotal.innerText = subtotal_counter
            shipping.innerText = shipping_counter
            total.innerText = total_counter + shipping_counter
            
            if(total.innerText == 0){
                checkout_button.style.opacity = 0
                add_checkout_button.style.opacity = 1
            }else{
                checkout_button.style.opacity = 1
                add_checkout_button.style.opacity = 0
            }

            cart_array.value = JSON.stringify(total_array)

        }else if(add_to_checkout.checked == false){
            // console.log(add_to_checkout.checked)
            product_id.name = ""
            product_price.name = ""
            product_name.name = ""
            product_quantity.name = ""

            subtotal.innerText = " "
            shipping.innerText = " "
            total.innerText = " "
            total_array = total_array.filter(function(ele){
                return ele.cart_id != id
                // console.log(ele.cart_id+" not equals "+ id,ele.cart_id != id)
            })
            // add_to_checkout.checked == true
            total_array.forEach(ele => {
            subtotal_counter += Number(ele.product_price*ele.product_quantity)
            shipping_counter += Number(ele.shipping_price)
            total_counter += Number(ele.product_price*ele.product_quantity)
            });

            subtotal.innerText = subtotal_counter
            shipping.innerText = shipping_counter
            total.innerText = total_counter + shipping_counter

            if(total.innerText == 0){
                checkout_button.style.opacity = 0
                add_checkout_button.style.opacity = 1
            }else{
                checkout_button.style.opacity = 1
                add_checkout_button.style.opacity = 0
            }

            cart_array.value = JSON.stringify(total_array)
            
            console.log(total_array)
        }
        
    }
</script>
@endsection