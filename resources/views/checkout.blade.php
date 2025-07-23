@extends('layouts.site_base')
@section('content')
    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Login Coupon Accordion Start -->
                    <div class="checkoutaccordion" id="checkOutAccordion">
                        <div class="card">
                            <h3>Please Enter Your Shipping Address OR Select From List if Already Created<span data-toggle="collapse" data-target="#logInaccordion">Select Address</span></h3>
                            <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <p>You Can Select Your Shipping Address from the Addresses Below</p>
                                    <div class="login-reg-form-wrap mt-20">
                                        <div class="row">
                                            <!-- Order Summary Details -->
                                            <div class="col-lg-12">
                                                <div class="order-summary-details mt-md-26 mt-sm-26">
                                                    <h2>Your Added Addresses</h2>
                                                    <div class="order-summary-content mb-sm-4">
                                                        <!-- Order Summary Table -->
                                                        <div class="order-summary-table table-responsive text-center">
                                                            @foreach ($shipping as $address)
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <ul>
                                                                                    <li>
                                                                                        <strong>Full Name: </strong>{{$address->first_name}} {{$address->last_name}}
                                                                                    </li>
                                                                                    <li>
                                                                                        <strong>Phone Number: </strong>{{$address->phone}}
                                                                                    </li>
                                                                                    <li>
                                                                                        <strong>Email Address: </strong>{{$address->email}}
                                                                                    </li>
                                                                                    <li>
                                                                                        <strong>Street Address: </strong>{{$address->street_address}}
                                                                                    </li>
                                                                                    <li>
                                                                                        <strong>State: </strong>{{$address->state}}
                                                                                    </li>
                                                                                    <li>
                                                                                        <strong>City: </strong>{{$address->city}}
                                                                                    </li>
                                                                                    <li>
                                                                                        <strong>Postal Code: </strong>{{$address->postcode}}
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                            <td class="d-flex justify-content-center" style="border-bottom: none">
                                                                                <ul class="">
                                                                                    <li>
                                                                                        <div class="custom-control custom-radio">
                                                                                            <input type="radio" id="shipping-address{{$address->id}}" name="shipping_address" style="transform: scale(2)"
                                                                                                onclick="setShippingID({{$address->id}})"
                                                                                            />
                                                                                            
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            @endforeach
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Login Coupon Accordion End -->
                </div>
            </div>
    
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h2>Billing Details</h2>
                        <div class="billing-form-wrap">
                            <form action="{{ route('checkout-handler') }}" method="POST" id="shipping">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">Company Name (Required for Wholesales Shipping)</label>
                                            <input type="text" id="f_name" placeholder="First Name" name="company_name" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">First Name</label>
                                            <input type="text" id="f_name" placeholder="First Name" name="first_name" />
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="l_name" class="required">Last Name</label>
                                            <input type="text" id="l_name" placeholder="Last Name" name="last_name" />
                                        </div>
                                    </div>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="email" class="required">Email Address</label>
                                    <input type="email" id="email" placeholder="Email Address" name="email" value="{{Auth::user()->email}}"  readonly/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="street-address" class="required pt-20">Street address</label>
                                    <input type="text" id="street-address" placeholder="Street address Line 1" name="street_address" />
                                </div>
                                <div class="single-input-item">
                                    <label for="town" class="required">Town / City</label>
                                    <input type="text" id="town"  placeholder="Town / City" name="city" />
                                </div>
    
                                <div class="single-input-item">
                                    <label for="state">State / Divition</label>
                                    <input type="text" id="state"  placeholder="State / Divition" name="state"/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" id="postcode"  placeholder="Postcode / ZIP" name="postcode" />
                                </div>
    
                                <div class="single-input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone"  placeholder="Phone" name="phone"/>
                                </div>
    
                                <div class="checkout-box-wrap">
                                    <div class="single-input-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="create_pwd">
                                            {{-- <label class="custom-control-label" for="create_pwd">Create an account?</label> --}}
                                        </div>
                                    </div>
                                    <div class="account-create single-form-row">
                                        {{-- <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p> --}}
                                        <div class="single-input-item">
                                            {{-- <label for="pwd" class="required">Account Password</label> --}}
                                            {{-- <input type="password" id="pwd"  placeholder="Account Password" required name="" /> --}}
                                        </div>
                                    </div>

                                    <input type="hidden" name="cart" value="{{json_encode($cart)}}">
                                    <input type="hidden" id="total-with-shipping" name="total_with_shipping">
                                    <input id="shipping-id" type="hidden" name="shipping_id">
                                    <input id="payment-method" type="hidden" name="payment_method">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details mt-md-26 mt-sm-26">
                        <h2>Your Order Summary</h2>
                        <div class="order-summary-content mb-sm-4">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subtotal = 0;
                                            $shipping_cost = 0;
                                        @endphp

                                        @foreach ($cart as $item)
                                            @php
                                                $product = App\Product::find($item->product_id);

                                                // cast everything to numbers before doing math
                                                $lineQty   = (float) $item->product_quantity;
                                                $linePrice = (float) $item->product_price;
                                                $lineShip  = (float) ($item->shipping_price ?? 0);

                                                $lineTotal  = $lineQty * $linePrice;
                                                $subtotal  += $lineTotal;
                                                $shipping_cost += $lineShip;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <a href="{{ route('products.show', $product) }}">
                                                        {{ $product->name }} ({{ $item->shopping_type }})
                                                        <strong> × {{ $item->product_quantity }}</strong>
                                                    </a>
                                                </td>
                                                <td>₦{{ number_format($lineTotal) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td><strong>₦ {{ number_format($subtotal) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="d-flex justify-content-center">
                                                <ul class="shipping-type">
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="flatrate" name="shipping" class="custom-control-input" checked />
                                                            <label class="custom-control-label" for="flatrate">Flat Rate: ₦ {{ number_format($shipping_cost) }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="freeshipping" name="shipping" class="custom-control-input" />
                                                            <label class="custom-control-label" for="freeshipping">Within Ile-Ife: Free Shipping</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td><strong>₦ <span id="grand-total">{{ number_format($shipping_cost + $subtotal, 2) }}</span></strong></td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method show">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked  />
                                            <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="cash">
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                </div>
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="paypalpayment" name="paymentmethod" value="paypal" class="custom-control-input" />
                                            <label class="custom-control-label" for="paypalpayment">Pay Online <img src="assets/img/paypal-card.jpg" class="img-fluid paypal-card" alt="Paypal" /></label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="paypal">
                                        <p>Pay with Card; you can pay with your credit card.</p>
                                    </div>
                                </div>
                                <div class="summary-footer-area">
                                    <button type="submit" class="check-btn sqr-btn"
                                        onclick="
                                            event.preventDefault();
                                            document.getElementById('shipping').submit();
                                        "
                                    >Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout main wrapper end -->
    <script>
        var shipping_id = document.getElementById('shipping-id')
        var cashon = document.getElementById('cashon')
        var card = document.getElementById('paypalpayment')
        var payment_method = document.getElementById('payment-method')

        document.getElementById('total-with-shipping').value = document.getElementById('grand-total').innerText

        console.log(document.getElementById('total-with-shipping').value)
        payment_method.value = "pay on delivery"

        cashon.onclick = () =>{
            payment_method.value = "pay on delivery"
        }
        card.onclick = () =>{
            payment_method.value = "card"
        }

        function setShippingID(id){
            // var new_shipping_id = document.getElementById('shipping-id'+id)
            shipping_id.value = id
            console.log(shipping_id)
        }
    </script>
@endsection