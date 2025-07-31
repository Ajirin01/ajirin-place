@php
    $categories = App\Category::where('status','Active')->get();
    $brands = App\Brand::where('status','Active')->get();

    if(Auth::check()){
        if(Session::get("sale_type") == 'wholesale'){
            $cart = App\Cart::where('user_id', Auth::user()->id)->get();
        }else{
            $cart = App\Cart::where('user_id', Auth::user()->id)->get();
        }
    }else{
        $cart = [];
    }
    

    // $cart = App\Cart::where('user_id', '1')->get();
    $subtotal = 0;

    if(Auth::check()){
        for($i=0; $i< count($cart); $i++){
            $subtotal += $cart[$i]->product_price * $cart[$i]->product_quantity;
        }
    }
    
    $wholesale = Session::get("sale_type") == 'wholesale';
    $retail = Session::get("sale_type") == 'retail';
    $empty = Session::get("sale_type") == null;
@endphp
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">

    <!-- Site title -->
    <title>Phase 2</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('site/assets/img/favicon.ico')}}" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('site/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="{{ asset('site/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- helper class css -->
    <link href="{{ asset('site/assets/css/helper.min.css') }}" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="{{ asset('site/assets/css/plugins.css') }}" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="{{ asset('site/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/css/skin-default.css') }}" rel="stylesheet" id="galio-skin">
    <script src="{{ asset('site/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
</head>

<body>
    <div class="wrapper">

        <!-- header area start -->
        <header>

            <!-- header top start -->
            <div class="header-top-area bg-gray text-center text-md-left">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-5">
                            <div class="header-call-action">
                                <a href="mailto:Support@Phase2.Com">
                                    <i class="fa fa-envelope"></i>
                                    request@ajirinplace.com
                                </a>
                                <a href="tel:+2347058508448">
                                    <i class="fa fa-phone"></i>
                                    +2347058508448
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-7">
                            <div class="header-top-right float-md-right float-none">
                                <nav>
                                    <ul>
                                        <li>
                                            <div class="dropdown header-top-dropdown">
                                                <a class="dropdown-toggle" id="myaccount" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    my account
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="myaccount">
                                                    <a class="dropdown-item" href="{{route('my-account')}}">my account</a>
                                                    @auth
                                                        <form id="logout" action="{{ route('logout') }}" method="post">
                                                            @csrf
                                                            <a class="dropdown-item" href="{{route('logout')}}"
                                                                onclick="
                                                                event.preventDefault();
                                                                document.getElementById('logout').submit();
                                                                "
                                                            > logout</a>
                                                        </form>
                                                    @endauth
                                                    @guest
                                                        <a class="dropdown-item" href="{{route('register-login')}}"> login</a>
                                                        <a class="dropdown-item" href="{{route('register-login')}}">register</a>
                                                    @endguest
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="{{route('cart')}}">my cart</a>
                                        </li>
                                        <li>
                                            <a href="{{route('cart')}}">checkout</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header top end -->

            <!-- header middle start -->
            <div class="header-middle-area pt-20 pb-20">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="brand-logo">
                                <a href="/">
                                    <img src="{{ asset('site/assets/img/logo/logo.png') }}" alt="brand logo">
                                </a>
                            </div>
                        </div> <!-- end logo area -->
                        <div class="col-lg-9">
                            <div class="header-middle-right">
                                <div class="header-middle-shipping mb-20">
                                    <div class="single-block-shipping">
                                        <div class="shipping-icon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h5>Working time</h5>
                                            <span>Mon- Sat: 10.00 - 17.00</span>
                                        </div>
                                    </div> <!-- end single shipping -->
                                    <div class="single-block-shipping">
                                        <div class="shipping-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h5>free shipping</h5>
                                            <span>On order over #100,000</span>
                                        </div>
                                    </div> <!-- end single shipping -->
                                    <div class="single-block-shipping">
                                        <div class="shipping-icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h5>free consultation</h5>
                                            <span>Preorder and get an invoice for free</span>
                                        </div>
                                    </div> <!-- end single shipping -->
                                </div>
                                <div class="header-middle-block">
                                    <div class="header-middle-searchbox">
                                        <form action="{{ route('search-results') }}" method="GET">
                                            @csrf
                                            <input name="search_query" type="text" placeholder="Search...">
                                            <button class="search-btn"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                    <div class="header-mini-cart">
                                        <div class="mini-cart-btn">
                                            <i class="fa fa-shopping-cart"></i>
                                            @auth
                                                <span class="cart-notification">{{$cart->count()}}</span>
                                            @endauth
                                            @guest
                                                <span class="cart-notification">0</span>
                                            @endguest
                                        </div>
                                        <div class="cart-total-price">
                                            <span>total</span>
                                            ₦{{ number_format($subtotal)}}
                                        </div>
                                        <ul class="cart-list">
                                            @foreach ($cart as $key=> $item)
                                            @php
                                                $product = App\Product::find($item->product_id);
                                                // echo json_encode($item->product_id);
                                            @endphp
                                                <li>
                                                    <div class="cart-img">
                                                        <a href="{{ route('product-details', $product->id) }}"><img src="{{ asset('public/uploads/'.$product->image) }}"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h4><a href="{{ route('product-details', $product->id) }}">{{$product->name}} x{{$item->product_quantity}}</a></h4>
                                                        <span>₦{{ number_format($product->price*$item->product_quantity)}}</span>
                                                    </div>
                                                    <div class="del-icon">
                                                        <a href="{{ route('delete_cart_item', $item->id) }}"><i class="fa fa-times"></i></a>
                                                    </div>
                                                </li>
                                            @endforeach
                                            
                                            <li class="mini-cart-price">
                                                <span class="subtotal">subtotal : </span>
                                                <span class="subtotal-price">₦{{ number_format($subtotal)}}</span>
                                            </li>
                                            <li class="checkout-btn">
                                                <a href="{{route('cart')}}">checkout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header middle end -->

            <!-- main menu area start -->
            <div class="main-header-wrapper bdr-bottom1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-header-inner">
                                <div class="category-toggle-wrap">
                                    <div class="category-toggle" id="category-toggle">
                                        category
                                        <div class="cat-icon">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <nav class="category-menu hm-1"  style="height:450px; overflow: overlay !important; ">
                                        <ul>
                                            @foreach ($categories as $category)
                                            <li><a href="{{ route('products-by-category', $category->name )}}"><i class="fa fa-circle"></i>
                                                {{$category->name}} <span>({{count($category->products)}})</span></a></li>
                                            @endforeach
                                            
                                        </ul>
                                    </nav>
                                </div>
                                <div class="main-menu">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li class="active"><a href="/"><i class="fa fa-home"></i>Home</a>
                                            </li>
                                            <li><a href="{{ route('shop') }}">shop</a>
                                            </li>
                                            <li><a href="{{ route('contact-us') }}">Contact us</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-block d-lg-none">
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main menu area end -->

        </header>
        <!-- header area end -->

        @yield('content')

        <!-- brand area start -->
        <div class="brand-area pt-4 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title mb-30">
                            <div class="title-icon">
                                <i class="fa fa-crop"></i>
                            </div>
                            <h3>Popular Brand</h3>
                        </div> <!-- section title end -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="brand-active slick-padding slick-arrow-style">
                            @foreach ($brands as $brand)
                                <div class="brand-item text-center">
                                    <a style="color: gray; font-weight: 800" href="{{ route('products-by-brand', $brand->name )}}"> 
                                        @php
                                            echo strtoupper($brand->name);
                                        @endphp 
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand area end -->

        <!-- footer area start -->
        <footer>
            <!-- footer top start -->
            <div class="footer-top bg-black pt-14 pb-14">
                <div class="container">
                    <div class="footer-top-wrapper">
                        <div class="newsletter__wrap">
                            <div class="newsletter__title">
                                <div class="newsletter__icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="newsletter__content">
                                    <h3>Want to get sale updates from our store?</h3>
                                    {{-- <p>Duis autem vel eum iriureDuis autem vel eum</p> --}}
                                </div>
                                
                            </div>
                            <div class="newsletter__box">
                                    <form action="{{ route('shopping-setting') }}" method="POST">
                                        @csrf
                                        <input name="shopping_type" value="wholesale" style="opacity: 0" type="text" id="mc-email" autocomplete="off" placeholder="wholesale">
                                        <button class="btn" id="mc-submit">Accept email notifications!</button>
                                    </form>
                            </div>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
                        </div>
                        <div class="social-icons">
                            <a href="https://facebook.com/holagoke.mubarrakh" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                            {{-- <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a> --}}
                            <a href="https://instagram.com/ajirin_place" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                            {{-- <a href="https://youtube.com/olagoke_mubarak" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer top end -->

            <!-- footer main start -->
            <div class="footer-widget-area pt-40 pb-38 pb-sm-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>contact us</h4>
                                </div>
                                <div class="widget-body">
                                    <ul class="location">
                                        <li><a href="mailto:support@phase2.com"><i class="fa fa-envelope"></i>request@ajirinplace.com</a></li>
                                        <li><a href="tel:+2347058508448"><i class="fa fa-phone"></i>+2347058508448</a></li>
                                        <li><i class="fa fa-map-marker"></i>Opp Mayfair Pharmacy, Ile-Ife, <br> Osun State, Nigeria</li>
                                    </ul>
                                    <a class="map-btn" href="{{ route('contact-us') }}">open in google map</a>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end -->
                        <div class="col-md-4 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>my account</h4>
                                </div>
                                <div class="widget-body">
                                    <ul>
                                        <li><a href="{{ route('my-account') }}">my account</a></li>
                                        <li><a href="{{ route('cart') }}">my cart</a></li>
                                        <li><a href="{{ route('checkout') }}">checkout</a></li>
                                        <li><a href="{{ route('register-login') }}">login</a></li>
                                    </ul>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end -->
                        {{-- <div class="col-md-3 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>short code</h4>
                                </div>
                                <div class="widget-body">
                                    <ul>
                                        <li><a href="#">gallery</a></li>
                                        <li><a href="#">accordion</a></li>
                                        <li><a href="#">carousel</a></li>
                                        <li><a href="#">map</a></li>
                                        <li><a href="#">tab</a></li>
                                    </ul>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end --> --}}
                        <div class="col-md-4 col-sm-6">
                            <div class="footer-widget mb-sm-30">
                                <div class="widget-title mb-10 mb-sm-6">
                                    <h4>product tags</h4>
                                </div>
                                <div class="widget-body">
                                    <ul>
                                        @foreach ($categories as $key=> $cat)
                                            <li><a href="{{ route('products-by-category', $cat->name) }}">{{ $cat->name }}</a></li>
                                            @if ($key == 3)
                                                @php
                                                    break;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($brands as $key=> $brand)
                                            <li><a href="{{ route('products-by-brand', $brand->name) }}">{{ $brand->name }}</a></li>
                                            @if ($key == 3)
                                                @php
                                                    break;
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{-- <li><a href="#">Suppliments</a></li>
                                        <li><a href="#">Anti-Malaria</a></li>
                                        <li><a href="#">Anti-Biotic</a></li>
                                        <li><a href="#">Hospital</a></li>
                                        <li><a href="#">Self Care</a></li> --}}
                                    </ul>
                                </div>
                            </div> <!-- single widget end -->
                        </div> <!-- single widget column end -->
                    </div>
                </div>
            </div>
            <!-- footer main end -->

            <!-- footer bootom start -->
            <div class="footer-bottom-area bg-gray pt-20 pb-20">
                <div class="container">
                    <div class="footer-bottom-wrap">
                        <div class="copyright-text">
                            <p><a target="_blank" href="https://www.ajirinibi.com.ng">Ajirinibi</a></p>
                        </div>
                        <div class="payment-method-img">
                            <img src="{{ asset('site/assets/img/payment.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer bootom end -->

        </footer>
        <!-- footer area end -->

    </div>
    
    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->



    <!--All jQuery, Third Party Plugins & Activation (main.js') }}) Files-->
    <script src="{{ asset('site/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <!-- Jquery Min Js -->
    <script src="{{ asset('site/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <!-- Popper Min Js -->
    <script src="{{ asset('site/assets/js/vendor/popper.min.js') }}"></script>
    <!-- Bootstrap Min Js -->
    <script src="{{ asset('site/assets/js/vendor/bootstrap.min.js') }}"></script>
    <!-- Plugins Js-->
    <script src="{{ asset('site/assets/js/plugins.js') }}"></script>
    <!-- Ajax Mail Js -->
    <script src="{{ asset('site/assets/js/ajax-mail.js') }}"></script>
    <!-- Active Js -->
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
    <!-- Switcher JS [Please Remove this when Choose your Final Projct] -->
    <script src="{{ asset('site/assets/js/switcher.js') }}"></script>

    <script>
        $(document).ready(function () {
            const currentPath = window.location.pathname;
            console.log(currentPath)

            // Don't toggle if it's the homepage ("/")
            if (currentPath !== "/") {
                document.getElementById("category-toggle").click();
            }
        });
    </script>

</body>



</html>