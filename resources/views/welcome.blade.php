@extends('layouts.app')

@section('content')

@include('layouts.homepage_slider')


<section class="ftco-section bg-light">
    
    <div class="container">
        @include('layouts.reporter')
        <div class="row">
            @foreach($products as $product)
            <div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
                <div class="product d-flex flex-column">
                    <a href="{{ productUrl($product) }}" class="img-prod"><img class="img-fluid" src="{{ $product->thumbnail->url }}" alt="Colorlib Template">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3">
                        <div class="d-flex">
                            <div class="cat">
                                <span>{{ $product->category->name }}</span>
                            </div>
                        </div>
                        <h3><a href="{{ productUrl($product) }}">{{ $product->name }}</a></h3>
                        <div class="pricing">
                            <p class="price"><span>{{ toCurrency($product->price) }}</span></p>
                        </div>
                        <p class="bottom-area d-flex px-3">
                            <a href="{{ productUrl($product, 'cart') }}" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                            <a href="{{ productUrl($product, 'buy') }}" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection