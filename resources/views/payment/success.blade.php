@extends('layouts.site_base')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <h2 class="mb-3 text-success">🎉 Order Placed Successfully!</h2>
        <p class="lead">Thank you for shopping with us.</p>
        <p>Your order has been received.</p>
        <p>You can track and manage your orders anytime from your <a href="{{ route('my-account') }}">Orders Page</a>.</p>
        
        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Return to Home</a>
        </div>
    </div>
</div>
@endsection
