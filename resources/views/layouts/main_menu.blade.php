<!-- Start: nav -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ URL('/') }}">OvStores</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ URL('/') }}" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalog</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="shop.html">Shop</a>
                        <a class="dropdown-item" href="product-single.html">Single Product</a>
                        <a class="dropdown-item" href="cart.html">Cart</a>
                        <a class="dropdown-item" href="checkout.html">Checkout</a>
                    </div>
                </li>
                @guest
                <li class="nav-item"><a href="{{ URL('/login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ URL('/register') }}" class="nav-link">Register</a></li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-user"></span>
                        {{Auth::user()->firstname}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{ URL('/my-account') }}">My Account</a>
                        <a class="dropdown-item" href="{{ URL('/settings') }}">Settings</a>
                        <a class="dropdown-item" href="{{ URL('/logout') }}">Logout</a>
                    </div>
                </li>
                @endguest
                <li class="nav-item cta cta-colored"><a href="{{ URL('/cart') }}" class="nav-link"><span class="icon-shopping_cart"></span>[{{ count(getCartItems()) }}]</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END: nav -->