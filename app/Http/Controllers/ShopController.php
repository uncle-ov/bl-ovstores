<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ShopController extends Controller
{
    //
    public function productDetails($id, $slug) {
        $product = Product::where('id', $id)
                            ->withCount('reviews')
                            ->withCount('sizes')
                            ->first();

        if($product == null) abort(404);

        // dd($id, $product);

        return view('product_details', [
            'product' => $product,
        ]);
    }

}
