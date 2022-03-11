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
                    <form method="POST" action="{{ URL('/my-account/update-info') }}">
                        @csrf
                        <div class="col-xl-12 ftco-animate" style="max-width: 500px;">
                            @include('layouts.reporter')
                            <div class="row align-items-end">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="firstname">First Name </label>
                                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $user->firstname) }}" placeholder="Enter your first name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lastname">Last Name </label>
                                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $user->lastname) }}" placeholder="Enter your last name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email Address </label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Enter your first name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p><input type="submit" class="btn btn-primary py-3 px-5" value="Save"></a></p>
                                    </div>
                                </div>
                            </div>
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