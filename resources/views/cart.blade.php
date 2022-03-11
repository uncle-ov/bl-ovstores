@extends('layouts.app')
@section('content')
<div class="hero-wrap hero-bread innerpage-header">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL('/') }}">Home</a></span>
                    <span>Cart</span>
                </p>
                <h1 class="mb-0 bread">Cart</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section ftco-cart">
    @if(!empty(count($cart_items)))
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart_items as $item)
                            <tr class="text-center">
                                <td class="product-remove"><a href="{{ URL('/cart/remove/'.$item->id) }}"><span class="ion-ios-close"></span></a></td>
                                <td class="image-prod">
                                    <div class="img" style="background-image:url({{ $item->product->thumbnail->url }});"></div>
                                </td>
                                <td class="product-name">
                                    <h3>{{ $item->product->name }}</h3>
                                </td>
                                <td class="price">{{ toCurrency($item->product->price) }}</td>
                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input
                                            type="number"
                                            name="quantity"
                                            class="cart_quantity_input quantity form-control input-number"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            data-price="{{ $item->product->price }}"
                                            data-id="{{ $item->product->id }}"
                                        >
                                    </div>
                                </td>
                                <td class="total">
                                    <span id="cartItemTotal{{ $item->product->id }}">
                                        {{ toCurrency(($item->product->price * $item->quantity)) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            <!-- END TR-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <span
                        id="currencySettings"
                        data-currency="{{ $shop_settings->currency }}"
                        data-decimals="{{ $shop_settings->amount_decimals }}"
                    ></span>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span id="cartSubTotal">...</span>
                    </p>
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span id="cartShipping" data-price="0">{{ toCurrency(0) }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Discount</span>
                        <span id="cartDiscount" data-price="0">{{ toCurrency(0) }}</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span id="cartTotalAmount">...</span>
                    </p>
                </div>
                <p class="text-center"><a href="{{ URL('/checkout') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
            </div>
        </div>
    </div>
    @else 
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <p>No items in cart &mdash; <a href="{{ URL('/') }}">Start Shopping</a></p>
          </div>
        </div>   		
    </div>
    @endif
</section>
@endsection