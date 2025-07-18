@extends('layouts.site_base')
@section('content')
    <!-- login register wrapper start -->
    <div class="login-register-wrapper">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-6">
                        <div class="login-reg-form-wrap  pr-lg-50">
                            <h2>Sign In</h2>
                            <form action="{{ route('authenticate') }}" method="post">
                                @csrf
                                <div class="single-input-item">
                                    <input type="email" placeholder="Email or Username" required name="email"/>
                                </div>
                                <div class="single-input-item">
                                    <input type="password" placeholder="Enter your Password" required name="password"/>
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <div class="remember-meta">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                <label class="custom-control-label" for="rememberMe" name="remember">Remember Me</label>
                                            </div>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="forget-pwd">Forget Password?</a>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <input class="sqr-btn" type="submit" value="Login" name="login">

                                    {{-- <button class="sqr-btn">Login</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->

                    <!-- Register Content Start -->
                    <div class="col-lg-6">
                        <div class="login-reg-form-wrap mt-md-34 mt-sm-34">
                            <h2>Singup Form</h2>
                            <form action="{{ route('authenticate') }}" method="post">
                                @csrf
                                <div class="single-input-item">
                                    <input type="text" placeholder="Full Name" required name="name"/>
                                </div>
                                <div class="single-input-item">
                                    <input type="email" placeholder="Enter your Email" required name="email"/>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" placeholder="Enter your Password" required name="password"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" placeholder="Repeat your Password" required name="password_confirmation"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <input class="sqr-btn" type="submit" value="Register" name="register">
                                    {{-- <button class="sqr-btn">Register</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Register Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
    
    <script>
        $(document).ready(function(){
            document.getElementById("category-toggle").click()
        })
    </script>
@endsection