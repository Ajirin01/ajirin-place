@extends('layouts.site_base')
@section('content')
<!-- cart main wrapper start -->
<div class="cart-main-wrapper">
    <div class="container">

        <div class="row mb-4">
            <div class="col-lg-12">
                <h3>Order Summary</h3>
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Total:</strong> ₦{{ number_format($order->order_total) }}</p>
                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                @if ($pickup)
                    <p><strong>Pickup:</strong> Visit our store showroom at: <b>Opp Mayfair Pharmacy, Ile-Ife,Osun State, Nigeria. </b>to pickup your order</p>
                @endif
            </div>

            @if(!$pickup && isset($shipping))
                <div class="col-lg-12">
                    <h4>Shipping Address</h4>
                    <ul>
                        <li><strong>Name:</strong> {{ $shipping['name'] ?? '-' }}</li>
                        <li><strong>Phone:</strong> {{ $shipping['phone'] ?? '-' }}</li>
                        <li><strong>Address:</strong> {{ $shipping['address'] ?? '-' }}</li>
                        <li><strong>City:</strong> {{ $shipping['city'] ?? '-' }}</li>
                        <li><strong>State:</strong> {{ $shipping['state'] ?? '-' }}</li>
                    </ul>
                </div>
            @endif
        </div>

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
                                <th class="pro-subtotal">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                @php
                                    $product = App\Product::find($item['product_id']);
                                @endphp
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="{{ route('product-details', $product->name) }}">
                                            <img class="img-fluid" src="{{ asset('public/uploads/'.$product->image) }}" alt="Product" />
                                        </a>
                                    </td>
                                    <td class="pro-title">
                                        {{ $product->name }} ({{ $item['shopping_type'] ?? 'standard' }})
                                    </td>
                                    <td class="pro-price">₦{{ number_format($item['product_price']) }}</td>
                                    <td class="pro-quantity">{{ $item['product_quantity'] }}</td>
                                    <td class="pro-subtotal">₦{{ number_format($item['product_price'] * $item['product_quantity']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- cart main wrapper end -->
@endsection
