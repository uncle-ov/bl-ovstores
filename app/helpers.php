<?php
    use \App\Models\ShopSetting;

    function getCartItems() {
        $cartItems = app(\App\Http\Controllers\CartController::class)->getCartItems();

        return $cartItems;
    }

    function toCurrency($amount, $dec = null) {
        $shop_settings = ShopSetting::first();

        $decimal = $dec == null ? $shop_settings->amount_decimals : 0;
        return $shop_settings->currency . ' ' . number_format($amount, $decimal);
    }

    function productUrl($product, $type = 'page') {
        if($type == 'page') {
            return URL('/products/'.$product->id.'/'.Str::slug($product->name));
        }

        return URL('/cart/add-now/'.$product->id.'/'.$type);
    }
