@extends('layouts.app')
@section('content')
<div class="hero-wrap hero-bread innerpage-header">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL('/') }}">Home</a></span>
                    <span>My Account</span>
                </p>
                <h1 class="mb-0 bread">Welcome, {{Auth::user()->firstname}}!</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 order-md-last">
                <div class="row">
                    <form action="{{ URL('/my-account/shipping-address/submit') }}" class="billing-form" method="post">
                        @csrf
                        <div class="col-xl-10 ftco-animate">
                            @include('layouts.reporter')
                            <h3 class="mb-4 billing-heading">Shipping Details</h3>
                            <div class="row align-items-end">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" name="phone" value="{{ old('phone', $user->shipping_address->phone) }}" class="form-control" placeholder="Enter your phone number">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="emailaddress">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Enter your email address" required>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Street Address</label>
                                        <input type="text" name="address" value="{{ old('address', $user->shipping_address->address) }}" class="form-control" placeholder="House number and street name" required>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="towncity">Town / City</label>
                                        <input type="text" name="city" value="{{ old('city', $user->shipping_address->city) }}" class="form-control" placeholder="Enter your town/city" required>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="postcodezip">Postcode / ZIP *</label>
                                        <input type="text" name="postal_code" value="{{ old('postal_code', $user->shipping_address->postal_code) }}" class="form-control" placeholder="Enter your postal or zip code" required>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="country" value="{{ old('country', $user->shipping_address->country) }}" id="" class="form-control" required>
                                                @foreach(['Nigeria', 'Ghana', 'Kenya', 'South Africa'] as $country)
                                                <option value="{{ $country }}" {{ $country == old('country', $user->shipping_address->country) ? 'selected' : '' }}>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p><input type="submit" class="btn btn-primary py-3 px-5" value="Save"></a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="sidebar">
                    @include('layouts.account_menu')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection