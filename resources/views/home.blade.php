@extends('layouts.site_base')

@section('content')

        <!-- hero slider start -->
        <div class="container">
          <div class="row">
              <div class="col-lg-12">
                    <div class="slider-wrapper-area">
                        <div class="hero-slider-active hero__1 slick-dot-style hero-dot">
                            <!-- Slide 1 -->
                            <div class="single-slider" style="background-image: url({{ asset('site/assets/img/slider/slider12_bg.jpg') }});">
                                <div class="container p-0">
                                    <div class="slider-main-content">
                                        <div class="slider-content-img">
                                            <img src="{{ asset('site/assets/img/slider/slider11_lable1.png') }}" alt="">
                                            <img src="{{ asset('site/assets/img/slider/slider11_lable2.png') }}" alt="">
                                            <img src="{{ asset('site/assets/img/slider/slider11_lable3.png') }}" alt="">
                                        </div>
                                        <div class="slider-text">
                                            <div class="slider-label">
                                                {{-- <img src="{{ asset('site/assets/img/slider/slider11_lable4.png') }}" alt=""> --}}
                                            </div>
                                            <h1 class="banner-text">Frames Made Just for You</h1>
                                            <p class="banner-text">Custom handcrafted frames tailored to your style and space</p>
                                            <a href="{{ route('shop') }}" class="btn btn-secondary mt-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="single-slider" style="background-image: url({{ asset('site/assets/img/slider/slider11_bg.jpg') }});">
                                <div class="container p-0">
                                    <div class="slider-main-content">
                                        <div class="slider-content-img">
                                            <img src="{{ asset('site/assets/img/slider/slider11_lable1.png') }}" alt="">
                                            <img src="{{ asset('site/assets/img/slider/slider11_lable2.png') }}" alt="">
                                            <img src="{{ asset('site/assets/img/slider/slider11_lable3.png') }}" alt="">
                                        </div>
                                        <div class="slider-text">
                                            <div class="slider-label">
                                                {{-- <img src="{{ asset('site/assets/img/slider/slider11_lable4.png') }}" alt=""> --}}
                                            </div>
                                            <h1 class="banner-text">Discover Art You’ll Love</h1>
                                            <p class="banner-text">Explore unique pieces and personalized craftsmanship from Ajirin Place</p>
                                            <a href="{{ route('shop') }}" class="btn btn-secondary mt-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

          </div>
      </div>
      <!-- hero slider end -->

      <!-- home banner area start -->
      <div class="banner-area mt-30">
          <div class="container">
              <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-6 order-1">
                      <div class="img-container img-full fix imgs-res mb-sm-30">
                          <a href="{{ route('products-by-category', 'Paintings' )}}">
                              <img src="{{ asset('site/assets/img/banner/banner_left.jpg') }}" alt="">
                          </a>
                      </div>
                  </div>
                  <div class="col-lg-5 col-md-5 order-sm-3">
                      <div class="img-container img-full fix mb-30">
                          <a href="#">
                              <img src="{{ asset('site/assets/img/banner/banner_static_top1.jpg') }}" alt="">
                          </a>
                      </div>
                      <div class="img-container img-full fix mb-30">
                          <a href="#">
                              <img src="{{ asset('site/assets/img/banner/banner_static_top2.jpg') }}" alt="">
                          </a>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-6 order-2 order-md-3">
                      <div class="img-container img-full fix">
                        <a href="{{ route('products-by-category', 'Furniture' )}}">
                            <img src="{{ asset('site/assets/img/banner/banner_static_top3.jpg') }}" alt="">
                        </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- home banner area end -->

      <!-- page wrapper start -->
      <div class="page-wrapper pt-6 pb-28 pb-md-6 pb-sm-6 pt-xs-36">
          <div class="container">
              <div class="row">
                  <!-- start home sidebar -->
                  <div class="col-lg-3">
                      <div class="home-sidebar">
                          <!-- hot deals area start -->
                          <div class="main-sidebar hot-deals-wrap mb-30">
                              <div class="section-title-2 d-flex justify-content-between mb-28">
                                  <h3>hot deals</h3>
                                  <div class="slick-append"></div>
                              </div> <!-- section title end -->
                              <div class="deals-carousel-active slick-padding slick-arrow-style">
                                  <!-- product single item start -->
                                  @foreach ($hot_deals as $product)
                                    @if (Session::get("sale_type") == "wholesale")
                                        <div class="product-item fix">
                                            <div class="product-thumb">
                                                <a href="{{ route('product-details', $product->name) }}">
                                                    <img src="{{ asset('public/uploads/'.$product->image) }}" class="img-pri" alt="">
                                                    <img style="transform: scale(1.2)" src="{{ asset('public/uploads/'.$product->image) }}" class="img-sec" alt="">
                                                </a>
                                                <div class="product-label">
                                                    <span>hot</span>
                                                </div>
                                                <div class="product-action-link">
                                                
                                                    <a href="{{ route('product-details', $product->name) }}" data-toggle="tooltip" data-placement="left" title="Add to cart"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                                <div class="pricebox">
                                                    <span class="regular-price">#{{$product->wholesale_price == null  ? $product->price : $product->wholesale_price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="product-item fix">
                                            <div class="product-thumb">
                                                <a href="{{ route('product-details', $product->name) }}">
                                                    <img src="{{ asset('public/uploads/'.$product->image) }}" class="img-pri" alt="">
                                                    <img style="transform: scale(1.2)" src="{{ asset('public/uploads/'.$product->image) }}" class="img-sec" alt="">
                                                </a>
                                                <div class="product-label">
                                                    <span>hot</span>
                                                </div>
                                                <div class="product-action-link">
                                                
                                                    <a href="{{ route('product-details', $product->name) }}" data-toggle="tooltip" data-placement="left" title="Add to cart"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                                <div class="pricebox">
                                                    <span class="regular-price">#{{$product->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                  @endforeach
                                  
                                  <!-- product single item end -->
                              </div>
                          </div>
                          <!-- hot deals area end -->

                      </div>
                  </div>
                  <!-- end home sidebar -->

                  <div class="col-lg-9">
                      <!-- featured category area start -->
                      <div class="feature-category-area">
                          <div class="section-title mb-30">
                              <div class="title-icon">
                                  <i class="fa fa-flask"></i>
                              </div>
                              <h3>New Arrivals</h3>
                          </div> <!-- section title end -->
                          <!-- featured category start -->
                          <div class="featured-carousel-active slick-padding slick-arrow-style">
                              <!-- product single item start -->
                              @foreach ($new_arrival as $product)
                                @if (Session::get("sale_mode") == "wholesale")
                                    <div class="product-item fix">
                                        <div class="product-thumb">
                                            <a href="{{ route('product-details', $product->name) }}">
                                                <img style="height: 300px" src="{{ asset('public/uploads/'.$product->image) }}" class="img-pri" alt="">
                                                <img style="height: 300px; transform: opacity(.8)" src="{{ asset('public/uploads/'.$product->image) }}" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>new</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="{{ route('product-details', $product->name) }}" data-toggle="tooltip" data-placement="left" title="Add to cart"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">#{{$product->wholesale_price == null  ? $product->price : $product->wholesale_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="product-item fix">
                                        <div class="product-thumb">
                                            <a href="{{ route('product-details', $product->name) }}">
                                                <img src="{{ asset('public/uploads/'.$product->image) }}" class="img-pri" alt="">
                                                <img style="transform: opacity(.8)" src="{{ asset('public/uploads/'.$product->image) }}" class="img-sec" alt="">
                                            </a>
                                            <div class="product-label">
                                                <span>new</span>
                                            </div>
                                            <div class="product-action-link">
                                                <a href="{{ route('product-details', $product->name ) }}" data-toggle="tooltip" data-placement="left" title="Add to cart"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                            <div class="pricebox">
                                                <span class="regular-price">#{{$product->price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                              @endforeach
                              
                              <!-- product single item end -->
                          </div>
                          <!-- featured category end -->
                      </div>
                      <!-- featured category area end -->

                      <!-- banner statistic start -->
                      <div class="banner-statistic pt-28 pb-36">
                          <div class="img-container fix img-full">
                              <a href="#">
                                  <img src="{{ asset('site/assets/img/banner/banner_static1.jpg') }}" alt="">
                              </a>
                          </div>
                      </div>
                      <!-- banner statistic end -->

                      <!-- category features area start -->
                      <div class="category-feature-area">
                          <div class="row">
                              <!-- New Products area start -->
                              <div class="col-lg-6">
                                  <div class="category-wrapper mb-md-24 mb-sm-24">
                                      <div class="section-title-2 d-flex justify-content-between mb-28">
                                          <h3>New Products</h3>
                                          <div class="category-append"></div>
                                      </div> <!-- section title end -->
                                      <div class="category-carousel-active row" data-row="4">
                                        @foreach ($latest_products as $product)
                                            @if (Session::get("sale_type") == "wholesale")
                                                <div class="col">
                                                    <div class="category-item">
                                                        <div class="category-thumb">
                                                            <a href="{{ route('product-details', $product->name) }}">
                                                                <img src="{{ asset('public/uploads/'.$product->image) }}" alt="latest product">
                                                            </a>
                                                        </div>
                                                        <div class="category-content">
                                                            <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                                            <div class="price-box">
                                                                <div class="regular-price">
                                                                    #{{$product->wholesale_price == null  ? $product->price : $product->wholesale_price }}
                                                                </div>
                                                                <div class="old-price">
                                                                    <del></del>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end single item -->
                                                </div>
                                            @else
                                                <div class="col">
                                                    <div class="category-item">
                                                        <div class="category-thumb">
                                                            <a href="{{ route('product-details', $product->name) }}">
                                                                <img src="{{ asset('public/uploads/'.$product->image) }}" alt="latest product">
                                                            </a>
                                                        </div>
                                                        <div class="category-content">
                                                            <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                                            <div class="price-box">
                                                                <div class="regular-price">
                                                                    #{{$product->price}}
                                                                </div>
                                                                <div class="old-price">
                                                                    <del></del>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end single item -->
                                                </div>
                                            @endif
                                             
                                            <!-- end single item column -->
                                        @endforeach
                                    </div>
                                  </div>
                              </div>
                              <!-- New Products area end -->
                              <!-- Most viewed area start -->
                              <div class="col-lg-6">
                                  <div class="category-wrapper mb-md-24 mb-sm-24">
                                      <div class="section-title-2 d-flex justify-content-between mb-28">
                                          <h3>hot sale</h3>
                                          <div class="category-append"></div>
                                      </div> <!-- section title end -->
                                      <div class="category-carousel-active row" data-row="4">
                                          @foreach ($hot_sales as $product)
                                            @if (Session::get("sale_type") == "wholesale")
                                                <div class="col">
                                                    <div class="category-item">
                                                        <div class="category-thumb">
                                                            <a href="{{ route('product-details', $product->name) }}">
                                                                <img src="{{ asset('public/uploads/'.$product->image) }}" alt="hot sale">
                                                            </a>
                                                        </div>
                                                        <div class="category-content">
                                                            <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                                            <div class="price-box">
                                                                <div class="regular-price">
                                                                    #{{$product->wholesale_price == null  ? $product->price : $product->wholesale_price }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end single item -->
                                                </div>
                                            @else
                                                <div class="col">
                                                    <div class="category-item">
                                                        <div class="category-thumb">
                                                            <a href="{{ route('product-details', $product->name) }}">
                                                                <img src="{{ asset('public/uploads/'.$product->image) }}" alt="hot sale">
                                                            </a>
                                                        </div>
                                                        <div class="category-content">
                                                            <h4><a href="{{ route('product-details', $product->name) }}">{{$product->name}}</a></h4>
                                                            <div class="price-box">
                                                                <div class="regular-price">
                                                                    #{{$product->price}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end single item -->
                                                </div>
                                            @endif
                                            
                                            <!-- end single item column -->
                                          @endforeach
                                      </div>
                                        
                                  </div>
                              </div>
                              <!-- Most viewed area end -->
                          </div>
                      </div>
                      <!-- category features area end -->
                  </div>
              </div>
          </div>
      </div>
      <!-- page wrapper end -->


    

    {{-- <a href="#" style="display: none"  data-toggle="modal" id="model2" data-target="#sale_type_switch"> <span data-toggle="tooltip" data-placement="left" title="sale_type_switch"><i class="fa fa-search"></i></span> </a>

    @php
        echo "<script>document.getElementById('model2').click()</script>";
    @endphp

    <!-- Quick view modal start -->
    <div class="modal" id="sale_type_switch">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    hello
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end --> --}}
    @if ((Session::get("sale_type") == null) && !Session::get('remember_setting'))
        <script>
            confirm("You are shopping retail mode, want to switch to Wholesale? You can always switch mode from the option on Navigation bar")
            document.getElementById("shopping-type").value = 'retail'
            document.getElementById("shopping-setting").submit()
        </script>
        {{Session::put('remember_setting', true)}}
    @endif

    @if (Session::get("sale_type") == "retail" && !Session::get('remember_setting'))
        <script>
            confirm("You are shopping retail mode, want to switch to Wholesale? You can always switch mode from the option on Navigation bar")
            document.getElementById("shopping-type").value = 'wholesale'
            document.getElementById("shopping-setting").submit()
        </script>
        {{Session::put('remember_setting', true)}}
    @endif

    @if (Session::get("sale_type") == "wholesale" && !Session::get('remember_setting'))
        <script>
            confirm("You are shopping Wholesale mode, want to switch to Retail? You can always switch mode from the option on Navigation bar")
            document.getElementById("shopping-type").value = 'retail'
            document.getElementById("shopping-setting").submit()
        </script>
        {{Session::put('remember_setting', true)}}
    @endif

    
@endsection
