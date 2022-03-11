@extends('layouts.app')
@section('content')
<div class="hero-wrap hero-bread innerpage-header">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL('/') }}">Home</a></span>
                    <span>Checkout</span>
                </p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        @include('layouts.reporter')
        <div class="row justify-content-center">
            <form action="{{ URL('/checkout/submit') }}" class="billing-form" method="post">
                <div class="col-xl-10 ftco-animate">
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    @guest
                    <p>Have an Account? <a href="{{ URL('/login') }}">Login</a></p>
                    @endguest
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $user->firstname) }}" placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input name="lastname" value="{{ old('lastname', $user->lastname) }}" type="text" class="form-control" placeholder="Enter your last name" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->shipping_address->phone) }}" class="form-control" placeholder="Enter your phone number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Enter your email address" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Street Address</label>
                                <input type="text" name="address" value="{{ old('address', $user->shipping_address->address) }}" class="form-control" placeholder="House number and street name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Town / City</label>
                                <input type="text" name="city" value="{{ old('city', $user->shipping_address->city) }}" class="form-control" placeholder="Enter your town/city" required>
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcodezip">Postcode / ZIP *</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code', $user->shipping_address->postal_code) }}" class="form-control" placeholder="Enter your postal or zip code" required>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        
                        @guest
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <label class="mr-3">
                                        <input id="checkoutCreateAccount" type="checkbox" name="checkout_create_account" value="yes"> Create an Account?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="checkout_set_password col-md-6" style="display: none;">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="checkout_set_password col-md-6" style="display: none;">
                            <div class="form-group">
                                <label for="lastname">Retype password</label>
                                <input name="password_confirmation" type="password" class="form-control" placeholder="Retype password">
                            </div>
                        </div>
                        @endguest
                    </div>
                    <!-- END -->
                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span>{{ toCurrency($summary['subtotal']) }}</span>
                                </p>
                                <p class="d-flex">
                                    <span>Delivery</span>
                                    <span>{{ toCurrency($summary['shipping']) }}</span>
                                </p>
                                <p class="d-flex">
                                    <span>Discount</span>
                                    <span>{{ toCurrency($summary['discount']) }}</span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>{{ toCurrency($summary['total']) }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment_method" value="Direct Bank Tranfer" class="mr-2"> Direct Bank Tranfer</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment_method" value="Mail in Cheque" class="mr-2"> Mail in Cheque</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="accept_terms" value="yes" class="mr-2"> I have read and accept the terms and conditions</label>
                                        </div>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <p><input type="submit" class="btn btn-primary py-3 px-4" value="Place an order"></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- .col-md-8 -->
        </div>
    </div>
</section>
<!-- .section -->
@endsection