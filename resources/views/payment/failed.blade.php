@extends('layouts.site_base')
@section('content')
<div class="container py-5 text-center">
    <h2>❌ Payment Failed</h2>
    <p>Something went wrong with your payment. Please try again.</p>
    <a href="{{ route('checkout') }}" class="btn btn-warning">Try Again</a>
</div>
@endsection
