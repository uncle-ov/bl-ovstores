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
                    <p>This page is under construction</p>
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