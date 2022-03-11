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
                    <div class="col-md-12 ftco-animate">
                        <a href="{{ URL('/admin/products/new') }}" class="btn btn-primary py-2 px-4">+ Add New</a>
                    </div>
                    <div style="padding: 7.5px"></div>
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table" width="100%">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th style="text-align: left">Product</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr class="text-center">
                                        <td class="product-remove" width="40">#{{ $product->id }}</td>
                                        <td class="image-prod" width="80">
                                            <div class="img" style="background-image:url({{ $product->thumbnail->url }});"></div>
                                        </td>
                                        <td class="product-name" style="text-align: left !important;">
                                            <h3>{{ $product->name }}</h3>
                                            <a href="{{ URL(productUrl($product)) }}" target="_blank" style="color: black;">View</a>
                                            &nbsp; &nbsp;
                                            <a href="{{ URL('/admin/products/'.$product->id.'/edit') }}">Edit</a>
                                            &nbsp; &nbsp;
                                            <a href="{{ URL('/admin/products/'.$product->id.'/delete') }}" class="text-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                        </td>
                                        <td class="price">{{ toCurrency($product->price) }}</td>
                                    </tr>
                                    @endforeach
                                    <!-- END TR-->
                                </tbody>
                            </table>
                        </div>
                    </div>
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