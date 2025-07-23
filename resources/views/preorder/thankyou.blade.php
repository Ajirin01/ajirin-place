@extends('layouts.site_base')

@section('content')
<!-- thank you area start -->
<div class="contact-area pb-34 pt-40 pb-md-18 pb-sm-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="contact-message text-center">
                    <h3 class="mb-3">🎉 Thank you for your pre-order!</h3>
                    <p>We’ve received your request and will review it shortly. You’ll be contacted via email or phone if needed.</p>
                    <p>Your Invoice Code: <strong>{{ $order->invoice_code }}</strong></p>

                    <div class="mt-4">
                        <a href="{{ route('preorder.invoice', $order->invoice_code) }}" class="sqr-btn">View Invoice</a>
                        <a href="{{ route('home') }}" class="sqr-btn ml-2">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- thank you area end -->
@endsection
