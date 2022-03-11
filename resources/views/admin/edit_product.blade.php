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
                    <form action="{{ URL('/admin/products/edit') }}" class="billing-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-xl-10 ftco-animate">
                            @include('layouts.reporter')
                            <h3 class="mb-4 billing-heading">Product Details</h3>
                            <div class="row align-items-end">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="Enter product name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control" placeholder="Enter product sku">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea type="text" name="short_description" class="form-control" placeholder="Product short description" required>{{ old('short_description', $product->short_desc) }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="long_description">Long Description</label>
                                        <textarea type="text" name="long_description" class="form-control" placeholder="Product long description" required>{{ old('long_description', $product->long_desc) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="Enter product price">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="price">Select Category</label>
                                        <select name="category" value="{{ old('category', $product->category_id) }}" id="" class="form-control" required>
                                        @foreach($categories as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('category', $product->category_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="price">Select Manufacturer</label>
                                        <select name="manufacturer" value="{{ old('manufacturer', $product->manufacturer_id) }}" id="" class="form-control" required>
                                        @foreach($manufacturers as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('manufacturer', $product->manufacturer_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
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