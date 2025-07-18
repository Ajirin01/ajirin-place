@extends('layouts.site_base')
@section('content')
    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper">
        <div class="container">
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h2>Shipping Details</h2>
                        <div class="billing-form-wrap">
                            <form action="{{ route('handle-edit-address', $address->id) }}" method="POST" id="shipping">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">Company Name (Required for Wholesales Shipping)</label>
                                            <input type="text" id="f_name" placeholder="Company Name" name="company_name" value="{{$address->company_name}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">First Name</label>
                                            <input type="text" id="f_name" placeholder="First Name" name="first_name" value="{{$address->first_name}}"/>
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="l_name" class="required">Last Name</label>
                                            <input type="text" id="l_name" placeholder="Last Name" name="last_name" value="{{$address->last_name}}"/>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="email" class="required">Email Address</label>
                                    <input type="email" id="email" placeholder="Email Address" name="email" value="{{Auth::user()->email}}"  readonly/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="street-address" class="required pt-20">Street address</label>
                                    <input type="text" id="street-address" placeholder="Street address Line 1" name="street_address" value="{{$address->street_address}}"/>
                                </div>
                                <div class="single-input-item">
                                    <label for="town" class="required">Town / City</label>
                                    <input type="text" id="town"  placeholder="Town / City" name="city" value="{{$address->city}}"/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="state">State / Divition</label>
                                    <input type="text" id="state"  placeholder="State / Divition" name="state" value="{{$address->state}}"/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" id="postcode"  placeholder="Postcode / ZIP" name="postcode" value="{{$address->postcode}}"/>
                                </div>
    
                                <div class="single-input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone"  placeholder="Phone" name="phone" value="{{$address->phone}}"/>
                                </div>
    
                                <div class="checkout-box-wrap">
                                    <div class="single-input-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="create_pwd">
                                            {{-- <label class="custom-control-label" for="create_pwd">Create an account?</label> --}}
                                        </div>
                                    </div>
                                    <div class="account-create single-form-row">
                                        {{-- <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p> --}}
                                        <div class="single-input-item">
                                            {{-- <label for="pwd" class="required">Account Password</label> --}}
                                            {{-- <input type="password" id="pwd"  placeholder="Account Password" required name="" /> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-footer-area">
                                    <button type="submit" class="check-btn sqr-btn form-control">Update Address</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout main wrapper end -->
@endsection