@if(Auth::user()->is_admin)
<div class="sidebar-box-2">
    <h2 class="heading">Shop Links</h2>
    <hr>
    <p><a href="{{ URL('/admin/products') }}">Products</a></p>
    <hr>
    <p><a href="{{ URL('/admin/orders') }}">Orders</a></p>
    <hr>
    <p><a href="{{ URL('/admin/shop-settings') }}">Shop Settings</a></p>
    <hr>
</div>
@endif
<div class="sidebar-box-2">
    <h2 class="heading">Quick Links</h2>
    <hr>
    <p><a href="{{ URL('/my-account') }}">My Account</a></p>
    <hr>
    <p><a href="{{ URL('/my-account/my-orders') }}">My Orders</a></p>
    <hr>
    <p><a href="{{ URL('/my-account/shipping-address') }}">Shipping Address</a></p>
    <hr>
</div>
