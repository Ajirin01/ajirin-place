@extends('layouts.site_base')

@section('content')
<!-- pre-order area start -->
<div class="contact-area pb-34 pt-40 pb-md-18 pb-sm-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="contact-message">
                    <h2>Pre-Order Product</h2>
                    <form method="POST" action="{{ route('preorder.store') }}" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="name" placeholder="Your Name *" type="text" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="email" placeholder="Email Address *" type="email" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="phone" placeholder="Phone Number" type="text">
                            </div>
                            <div class="col-12">
                                <div class="contact2-textarea text-center">
                                    <textarea name="product_details" placeholder="Describe what you want *" class="form-control2" required></textarea>
                                </div>
                                <div class="contact-btn">
                                    <button class="sqr-btn" type="submit">Submit Pre-Order</button>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- pre-order area end -->
@endsection
