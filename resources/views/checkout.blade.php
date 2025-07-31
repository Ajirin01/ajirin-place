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
                                                                                            <input type="radio" 
                                                                                                id="shipping-address{{$address->id}}" 
                                                                                                name="shipping_address"
                                                                                                value="{{$address->id}}"
                                                                                                style="transform: scale(2)"
                                                                                                onclick="setShippingID({{ $address->id }}, '{{ $address->city }}', '{{ $address->state }}')"
                                                                                                {{ $address->is_default ? 'checked' : '' }}
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

            @php
                $defaultAddress = $shipping->firstWhere('is_default', true);
                $defaultExists = !is_null($defaultAddress);
            @endphp
    
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h2>Billing Details</h2>
                        <div class="billing-form-wrap">
                            @if($defaultExists)
                                <div class="mb-3">
                                    <label>
                                        <input type="checkbox" id="use-new-address" onchange="toggleAddressFields(this)"> Use a different address
                                    </label>
                                </div>
                            @endif

                            <form action="{{ route('checkout-handler') }}" method="POST" id="shipping">
                                @csrf
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">Company Name (Required for Wholesales Shipping)</label>
                                            <input type="text" id="f_name" placeholder="First Name" name="company_name" />
                                        </div>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">First Name</label>
                                            <input type="text" id="f_name" value="{{ $defaultAddress->first_name ?? '' }}" placeholder="First Name" name="first_name" {{ $defaultExists ? 'disabled' : '' }} />
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="l_name" class="required">Last Name</label>
                                            <input type="text" id="l_name" value="{{ $defaultAddress->last_name ?? '' }}" placeholder="Last Name" name="last_name" {{ $defaultExists ? 'disabled' : '' }} />
                                        </div>
                                    </div>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="email" class="required">Email Address</label>
                                    <input type="email" id="email" value="{{ $defaultAddress->email ?? '' }}" placeholder="Email Address" name="email" value="{{Auth::user()->email}}"  readonly/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="street-address" class="required pt-20">Street address</label>
                                    <input type="text" id="street-address" value="{{ $defaultAddress->street_address ?? '' }}" placeholder="Street address Line 1" name="street_address" {{ $defaultExists ? 'disabled' : '' }} />
                                </div>
                                <div class="single-input-item">
                                    <label for="town" class="required">Town / City</label>
                                    <input type="text" id="town" value="{{ $defaultAddress->city ?? '' }}"  placeholder="Town / City" name="city" {{ $defaultExists ? 'disabled' : '' }} />
                                </div>
    
                                <div class="single-input-item">
                                    <label for="state">State / Divition</label>
                                    <input type="text" id="state" value="{{ $defaultAddress->state ?? '' }}"  placeholder="State / Divition" name="state" {{ $defaultExists ? 'disabled' : '' }}/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" id="postcode" value="{{ $defaultAddress->postcode ?? '' }}"  placeholder="Postcode / ZIP" name="postcode" {{ $defaultExists ? 'disabled' : '' }} />
                                </div>
    
                                <div class="single-input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" value="{{ $defaultAddress->phone ?? '' }}"  placeholder="Phone" name="phone" {{ $defaultExists ? 'disabled' : '' }}/>
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
                                    <input type="checkbox" name="pickup" id="pickup" style="display: none">
                                    <input type="hidden" id="shipping-cost" name="shipping_cost">
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
                                                            {{-- <label class="custom-control-label" for="flatrate">Flat Rate: ₦ {{ number_format($shipping_cost) }}</label> --}}
                                                            <label class="custom-control-label" for="flatrate">Flat Rate: ₦ <span id="shipping-display">0</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="freeshipping" name="shipping" class="custom-control-input" />
                                                            <label class="custom-control-label" for="freeshipping">PickUp at store: Free Shipping</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            {{-- <td><strong>₦ <span id="grand-total">{{ number_format($shipping_cost + $subtotal, 2) }}</span></strong></td> --}}
                                            <td><strong>₦ <span id="grand-total">0</span></strong></td>
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
                                            <label class="custom-control-label" for="paypalpayment">Pay Online <img src="site/assets/img/paypal-card.jpg" class="img-fluid paypal-card" alt="Paypal" /></label>
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
        var freeshipping = document.getElementById('freeshipping')
        var payment_method = document.getElementById('payment-method')
        var flatrate = document.getElementById('flatrate')
        var pickup = document.getElementById('pickup')

        

        document.getElementById('total-with-shipping').value = document.getElementById('grand-total').innerText

        console.log(document.getElementById('total-with-shipping').value)
        payment_method.value = "pay on delivery"

        cashon.onclick = () =>{
            payment_method.value = "pay on delivery"
        }
        card.onclick = () =>{
            payment_method.value = "card"
        }

        const zones = {
            zoneA: {
                fee: 1500,
                areas: ['Lagos', 'Ikeja', 'Yaba', 'Lekki', 'Ojota']
            },
            zoneB: {
                fee: 2500,
                areas: ['Ibadan', 'Abeokuta', 'Ilorin', 'Akure']
            },
            zoneC: {
                fee: 3500,
                areas: ['Abuja', 'Enugu', 'Port Harcourt', 'Kano']
            },
            zoneDefault: {
                fee: 5000
            }
        };

        function calculateShipping() {
            const address = document.getElementById('customer-address').value.toLowerCase();
            let matched = false;

            for (const zone in zones) {
                if (zone === 'zoneDefault') continue;
                for (const area of zones[zone].areas) {
                    if (address.includes(area.toLowerCase())) {
                        setShippingFee(zones[zone].fee);
                        matched = true;
                        return;
                    }
                }
            }

            if (!matched) setShippingFee(zones.zoneDefault.fee);
        }

        const subtotal = {{ $subtotal ?? 0 }};

        function setShippingFee(amount) {
            document.getElementById('shipping-cost').value = amount;
            if(amount != 0){
                document.getElementById('shipping-display').innerText = amount.toLocaleString();
            }
            const grandTotal = parseFloat(amount) + parseFloat(subtotal);
            document.getElementById('grand-total').innerText = grandTotal.toLocaleString(undefined, { minimumFractionDigits: 2 });

            document.getElementById('total-with-shipping').value = grandTotal.toFixed(2); // update hidden input
        }


        function getShippingFee(){
            let fee 
            fee = document.getElementById('shipping-display').innerText
            return fee
        }
    </script>

    <script>
        function toggleAddressFields(checkbox) {
            const form = document.getElementById('shipping');
            const inputs = form.querySelectorAll('input[type="text"], input[type="email"]');
            inputs.forEach(input => {
                if (input.name !== 'shipping_cost' && input.name !== 'shipping_id') {
                    input.disabled = !checkbox.checked;
                }
            });
        }

        function setShippingID(id, city, state) {
            console.log(id, city, state)
            const shipping_id = document.getElementById('shipping-id');
            shipping_id.value = id;

            // Match city or state to zone and set shipping fee
            const input = (city + ' ' + state).toLowerCase();

            let matched = false;
            for (const zone in zones) {
                if (zone === 'zoneDefault') continue;
                for (const area of zones[zone].areas) {
                    if (input.includes(area.toLowerCase())) {
                        setShippingFee(zones[zone].fee);
                        matched = true;
                        break;
                    }
                }
                if (matched) break;
            }

            if (!matched) setShippingFee(zones.zoneDefault.fee);
        }

        freeshipping.onclick = () =>{
            pickup.checked = true
            setShippingFee(0)
        }

        flatrate.onclick = () => {
            const amountText = document.getElementById('shipping-display').innerText.replace(/[^\d]/g, ''); // removes commas and symbols
            const amount = Number(amountText);
            // alert(amountText)
            pickup.checked = false
            setShippingFee(amount);
        };


        // On page load: pre-calculate shipping based on default address
        window.onload = function () {
            const defaultRadio = document.querySelector('input[name="shipping_address"]:checked');
            if (defaultRadio) {
                const city = '{{ $defaultAddress->city ?? '' }}';
                const state = '{{ $defaultAddress->state ?? '' }}';
                setShippingID(defaultRadio.value, city, state);
            }
        };
    </script>

@endsection