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
            <div class="col-12">
                <h3>Thank you!</h3>
                <p>Your order was successfully submitted. We will update you with an email when we confirm your payment.</p>
            </div>
            <!-- .col-md-8 -->
        </div>
    </div>
</section>
<!-- .section -->
@endsection