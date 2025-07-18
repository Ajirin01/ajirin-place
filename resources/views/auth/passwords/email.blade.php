@extends('layouts.site_base')

@section('content')
<!-- login register wrapper start -->
<div style="margin-top: 20px" class="login-register-wrapper">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row justify-content-center">
                <!-- Login Content Start -->
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap  pr-lg-50">
                        <h2>{{ __('Reset Password') }}</h2>
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="single-input-item">
                                <input type="email" placeholder="Emai" required name="email"/>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="single-input-item">
                                <input class="sqr-btn" type="submit" value="Login" name="login">

                                {{-- <button class="sqr-btn">Login</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login Content End -->
            </div>
        </div>
    </div>
</div>
@endsection
