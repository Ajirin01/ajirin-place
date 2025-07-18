@extends('layouts.site_base')
@section('content')
    <!-- product details wrapper start -->
    <div class="product-details-wrapper">
        <div class="container">
            <div class="row align-items-end">
                @if (Session::get('shopping_type') == 'wholesale')
                    <div class="col-lg-9 offset-md-4">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-large-slider mb-20 slick-arrow-style_2">
                                    <div class="pro-large-img img-zoom" id="img1">
                                        <img src="{{ asset('public/uploads/'.$product->image) }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>{{$product->wholesale_stock}} in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">#{{$product->wholesale_price == null  ? $product->price : $product->wholesale_price }}</span>
                                    </div>
                                    {{-- {{$product->description}} --}}
                                    @php
                                        echo $product->description;
                                    @endphp
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <form id="{{$product->id}}" action="{{ route('add-to-cart') }}" method="post">
                                            @csrf
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="1" name="product_quantity">
                                                </div>
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                <input type="hidden" value="{{$product->wholesale_price == null  ? $product->price : $product->wholesale_price }}" name="product_price">
                                                <input type="hidden" name="shopping_type" value="{{Session::get('shopping_type')}}">

                                            </div>
                                            <div class="action_link">
                                                <a class="buy-btn" href="{{ route('add-to-cart') }}" 
                                                    onclick="
                                                    event.preventDefault();
                                                    document.getElementById({{$product->id}}).submit()
                                                    "
                                                >add to cart<i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews mt-34">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#tab_two">information</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                {{-- {{$product->description}} --}}
                                                @php
                                                    echo $product->description;
                                                @endphp
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>size</td>
                                                        <td>shipping cost</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$product->size}}</td>
                                                        <td>{{$product->shipping_cost}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- product details reviews end --> 

                    <!-- related products area start -->
                    <div class="related-products-area mt-34">
                        <div class="section-title mb-30">
                            <div class="title-icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <h3>related products</h3>
                        </div> <!-- section title end -->
                        <!-- featured category start -->
                        @php
                            $relate = "%".$product->name."%";
                            $related_products = App\Product::where('name', 'like', $relate )->get();
                        @endphp
                        <div class="featured-carousel-active slick-padding slick-arrow-style">
                            @foreach ($related_products as $product)
                                <!-- product single item start -->
                            <div class="product-item fix">
                                <div class="product-thumb">
                                    <a href="{{ route('product-details', $product->name) }}">
                                        <img src="{{asset('public/uploads/'.$product->image)}}" class="img-pri" alt="">
                                        <img style="transform: scale(1.2)" src="{{asset('public/uploads/'.$product->image)}}" class="img-sec" alt="">
                                    </a>
                                    <div class="product-action-link">
                                        {{-- <a href="#" data-toggle="modal" data-target="#quick_view"> <span data-toggle="tooltip" data-placement="left" title="Quick view"><i class="fa fa-search"></i></span> </a> --}}
                                        <a href="{{route('add-to-cart')}}" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- product single item end -->
                            @endforeach
                            
                        </div>
                        <!-- featured category end -->
                    </div>
                    <!-- related products area end -->
                </div>
                @else
                    <div class="col-lg-9 offset-md-4">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-large-slider mb-20 slick-arrow-style_2">
                                    <div class="pro-large-img img-zoom" id="img1">
                                        <img src="{{ asset('public/uploads/'.$product->image) }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>{{$product->stock}} in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">#{{$product->price}}</span>
                                    </div>
                                    {{-- {{$product->description}} --}}
                                    @php
                                        echo $product->description;
                                    @endphp
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <form id="{{$product->id}}" action="{{ route('add-to-cart') }}" method="post">
                                            @csrf
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="1" name="product_quantity">
                                                </div>
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                <input type="hidden" value="{{$product->price}}" name="product_price">
                                                <input type="hidden" name="shopping_type" value="{{Session::get('shopping_type')}}">
                                            </div>
                                            <div class="action_link">
                                                <a class="buy-btn" href="{{ route('add-to-cart') }}" 
                                                    onclick="
                                                    event.preventDefault();
                                                    document.getElementById({{$product->id}}).submit()
                                                    // document.getElementById('model').click()
                                                    
                                                    "
                                                >add to cart<i class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </form>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews mt-34">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#tab_two">information</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                {{-- {{$product->description}} --}}
                                                @php
                                                    echo $product->description;
                                                @endphp
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>size</td>
                                                        <td>shipping cost</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$product->size}}</td>
                                                        <td>{{$product->shipping_cost}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- product details reviews end --> 

                    <!-- related products area start -->
                    <div class="related-products-area mt-34">
                        <div class="section-title mb-30">
                            <div class="title-icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <h3>related products</h3>
                        </div> <!-- section title end -->
                        <!-- featured category start -->
                        @php
                            $relate = "%".$product->name."%";
                            $related_products = App\Product::where('name', 'like', $relate )->get();
                        @endphp
                        <div class="featured-carousel-active slick-padding slick-arrow-style">
                            @foreach ($related_products as $product)
                                <!-- product single item start -->
                            <div class="product-item fix">
                                <div class="product-thumb">
                                    <a href="{{ route('product-details', $product->name) }}">
                                        <img src="{{asset('public/uploads/'.$product->image)}}" class="img-pri" alt="">
                                        <img style="transform: scale(1.2)" src="{{asset('public/uploads/'.$product->image)}}" class="img-sec" alt="">
                                    </a>
                                    <div class="product-action-link">
                                        {{-- <a href="#" data-toggle="modal" data-target="#quick_view"> <span data-toggle="tooltip" data-placement="left" title="Quick view"><i class="fa fa-search"></i></span> </a> --}}
                                        <a href="{{route('add-to-cart')}}" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- product single item end -->
                            @endforeach
                            
                        </div>
                        <!-- featured category end -->
                    </div>
                    <!-- related products area end -->
                </div>
                @endif
                
            </div>
        </div>
    </div>
    <!-- product details wrapper end -->



    <!-- Quick view modal start -->
    @if (Session::get('msg') == "created")
        <div class="modal" id="quick_view">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="product-large-slider slick-arrow-style_2 mb-20">
                                        <div class="pro-large-img">
                                            <img src="{{ asset('public/uploads/'.$product->image) }}" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-details-des mt-md-34 mt-sm-34">
                                        <div class="pricebox">
                                            <span class="regular-price">Item added to cart: <br> <b class="text-primary">Summary</b> </span>
                                        </div>
                                        <div class="availability mt-10">
                                            <h5>Item Quantity:</h5>
                                            <span>{{Session::get('cart')['product_quantity']}}</span>
                                        </div>
                                        <div class="pricebox">
                                            <span class="regular-price">#{{Session::get('cart')['product_price']}} per item</span>
                                        </div>
                                        <h5>Item(s) total cost: <span>#{{Session::get('cart')['product_quantity'] * Session::get('cart')['product_price']}}</span></h5>
                                        <div class="quantity-cart-box d-flex align-items-center mt-20">
                                            <div class="action_link">
                                                <a class="buy-btn" href="#" class="close" data-dismiss="modal">Continue Shopping </a>
                                                <a class="buy-btn" href="{{route('cart')}}">Checkout now! </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details inner end -->
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Quick view modal end -->

    {{-- @php
        if (Session::get('msg') == "created"){
        
        echo "<script> document.getElementById('model').click() </script>";
        // echo Session::get('msg') == "created";
        }
        Session::put('msg', '');
    @endphp --}}
    @if (Session::get('msg') == "created")
        <a href="#" data-toggle="modal" id="model" data-target="#quick_view"> <span data-toggle="tooltip" data-placement="left" title="Quick view"><i class="fa fa-search"></i></span> </a>

        <script>$(document).ready(function(){
            document.getElementById('model').click()
        })</script>
        {{Session::put('msg', '')}}
        {{Session::put('cart', '')}}
    @endif
@endsection