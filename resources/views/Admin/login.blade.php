@extends('layouts.auth')

@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="/"><b style="color: white">Phase2</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in</p>
        
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <select class="form-control" name="branch" id="">
                  {{-- <option value="">Please select office branch</option> --}}
                  <option value="asaba">Ile-Ife</option>
                  {{-- <option value="minna">Minna</option> --}}
                </select>
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-home"></span>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                    Remember Me
                    </label>
                </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
