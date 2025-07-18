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
                                <th class="pro-subtotal">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                <form id="update-cart" action="" method="post">
                                    @csrf
                                    @foreach ($cart as $cart)
                                        <tr>
                                            @php
                                                $product = App\Product::find($cart->product_id);
                                            @endphp
                                            <td class="pro-thumbnail">
                                                <a href="{{ route('product-details', $product->name) }}"><img class="img-fluid" src="{{asset('public/uploads/'.$product->image)}}"
                                                                                        alt="Product"/></a></td>
                                            <td class="pro-title">{{$product->name}}({{$cart->shopping_type}})<a href="{{ route('product-details', $product->name) }}">
                                                
                                            </a></td>
                                            <td class="pro-price"><span>#{{$cart->product_price}}</span></td>
                                            <td class="pro-quantity">
                                                <span>#{{$cart->product_quantity}}</span>
                                            </td>

                                            <td class="pro-subtotal"><span>#{{$cart->product_quantity * $cart->product_price}}</span></td>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    <!-- cart main wrapper end -->

@endsection