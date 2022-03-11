@extends('layouts.app')

@section('content')
<div class="hero-wrap hero-bread innerpage-header">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL('/') }}">Home</a></span>
                    <span>Login</span>
                </p>
                <h1 class="mb-0 bread">Login</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-xl-12 ftco-animate" style="max-width: 400px;">
                    @include('layouts.reporter')
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email address </label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email address" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" value="" type="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <p><input type="submit" class="btn btn-primary py-3 px-5" value="Login"></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
