<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
        $products = Product::where('category_id', 1)->take(8)->get();

        // dd($products);
        return view('welcome', [
            'products' => $products,
        ]);
    }
}
