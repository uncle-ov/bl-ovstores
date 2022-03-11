@extends('layouts.app')

@section('content')
<div class="hero-wrap hero-bread innerpage-header">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL('/') }}">Home</a></span>
                    <span class="mr-2"><a href="{{ URL('category/' . $product->category->id . '/' . Str::slug($product->category->name)) }}">{{ $product->category->name }}</a></span>
                    <span>Shop</span>
                </p>
                <h1 class="mb-0 bread">Shop</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        @include('layouts.reporter')

        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="{{ $product->thumbnail->url }}" class="image-popup prod-img-bg"><img src="{{ $product->thumbnail->url }}" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{ $product->name }}</h3>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2">5.0</a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                    </p>
                    <!-- <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p> -->
                </div>
                <p class="price"><span>{{ toCurrency($product->price) }}</span></p>

                <form action="{{ URL('/cart/add') }}" method="post">
                {!! $product->short_desc !!}
                <div class="row mt-4">
                    @if(!empty($product->sizes_count))
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="size" id="" class="form-control">
                                    @foreach($product->sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                        <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                        <i class="ion-ios-remove"></i>
                        </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                        <span class="input-group-btn ml-2">
                        <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                        <i class="ion-ios-add"></i>
                        </button>
                        </span>
                    </div>
                    <div class="w-100"></div>
                </div>
                <p><input name="add_to_cart" type="submit" class="btn btn-black py-3 px-5 mr-2" value="Add to Cart"> <input name="buy_now" type="submit" class="btn btn-primary py-3 px-5" value="Buy now"></p>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 nav-link-wrap">
                <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>
                    <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Manufacturer</a>
                    <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Reviews</a>
                </div>
            </div>
            <div class="col-md-12 tab-wrap">
                <div class="tab-content bg-light" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                        <div class="p-4">
                            <h3 class="mb-4">{{ $product->name }}</h3>
                            {!! $product->long_desc !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                        <div class="p-4">
                            <h3 class="mb-4">Manufactured By {{ $product->manufacturer->name }}</h3>
                            <p>{!! $product->manufacturer->description !!}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                        <div class="row p-4">
                            <div class="col-md-7">
                                <h3 class="mb-4">{{ $product->reviews_count }} Reviews</h3>

                                @if(empty($product->reviews_count))
                                <p>No reviews on the product</p>
                                @else
                                <div class="review">
                                    <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                                    <div class="desc">
                                        <h4>
                                            <span class="text-left">Jacob Webb</span>
                                            <span class="text-right">14 March 2018</span>
                                        </h4>
                                        <p class="star">
                                            <span>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            </span>
                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                        </p>
                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                    </div>
                                </div>
                                <div class="review">
                                    <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                                    <div class="desc">
                                        <h4>
                                            <span class="text-left">Jacob Webb</span>
                                            <span class="text-right">14 March 2018</span>
                                        </h4>
                                        <p class="star">
                                            <span>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            </span>
                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                        </p>
                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                    </div>
                                </div>
                                <div class="review">
                                    <div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                                    <div class="desc">
                                        <h4>
                                            <span class="text-left">Jacob Webb</span>
                                            <span class="text-right">14 March 2018</span>
                                        </h4>
                                        <p class="star">
                                            <span>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            <i class="ion-ios-star-outline"></i>
                                            </span>
                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                        </p>
                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="rating-wrap">
                                    <h3 class="mb-4">Submit a Review</h3>
                                    
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
