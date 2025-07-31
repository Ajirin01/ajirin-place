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
                        <form action="{{ route('handle-add-address') }}" method="POST" id="shipping">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="f_name" class="required">First Name</label>
                                        <input type="text" id="f_name" placeholder="First Name" name="first_name"
                                            value="{{ old('first_name', $address->first_name ?? '') }}" />
                                        @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="l_name" class="required">Last Name</label>
                                        <input type="text" id="l_name" placeholder="Last Name" name="last_name"
                                            value="{{ old('last_name', $address->last_name ?? '') }}" />
                                        @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label for="email" class="required">Email Address</label>
                                <input type="email" id="email" placeholder="Email Address" name="email"
                                    value="{{ old('email', Auth::user()->email ?? '') }}" readonly />
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="single-input-item">
                                <label for="street-address" class="required pt-20">Street address</label>
                                <input type="text" id="street-address" placeholder="Street address Line 1"
                                    name="street_address"
                                    value="{{ old('street_address', $address->street_address ?? '') }}" />
                                @error('street_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="single-input-item">
                                <label for="town" class="required">Town / City</label>
                                <input type="text" id="town" placeholder="Town / City" name="city"
                                    value="{{ old('city', $address->city ?? '') }}" />
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="single-input-item">
                                <label for="state">State / Divition</label>
                                <input type="text" id="state" placeholder="State / Divition" name="state"
                                    value="{{ old('state', $address->state ?? '') }}" />
                                @error('state')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="single-input-item">
                                <label for="postcode" class="required">Postcode / ZIP</label>
                                <input type="text" id="postcode" placeholder="Postcode / ZIP" name="postcode"
                                    value="{{ old('postcode', $address->postcode ?? '') }}" />
                                @error('postcode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="single-input-item">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" placeholder="Phone" name="phone"
                                    value="{{ old('phone', $address->phone ?? '') }}" />
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="summary-footer-area mt-3">
                                <button type="submit" class="check-btn sqr-btn form-control">Create Address</button>
                            </div>

                            <div class="single-input-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_default" name="is_default"
                                        {{ old('is_default', $address->is_default ?? '') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_default">Set as default shipping address</label>
                                </div>
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
