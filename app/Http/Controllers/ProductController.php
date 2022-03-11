<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\ProductCategory;
use App\Models\ProductManufacturer;
use Image;

class ProductController extends Controller
{
    //
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->is_admin) {
                return redirect('my-account');
            }
            return $next($request);
        });
        
    }

    public function index() {
        $products = Product::orderBy('id', 'desc')->get();

        return view('admin.products', [
            'products' => $products,
        ]);
    }

    public function newProduct() {
        $categories = ProductCategory::get();
        $manufacturers = ProductManufacturer::get();

        return view('admin.new_product', [
            'categories' => $categories,
            'manufacturers' => $manufacturers,
        ]);
    }

    public function addProduct(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'manufacturer' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath, $name);
    
            $image_url =  URL('/images/products/' . $name);
        }
    
        $pid = Product::insertGetId([
            'category_id' => $data['category'],
            'manufacturer_id' => $data['manufacturer'],
            'name' => $data['name'],
            'sku' => !empty($data['sku']) ? $data['sku'] : '',
            'short_desc' => $data['short_description'],
            'long_desc' => $data['long_description'],
            'price' => $data['price'],
            'is_downloadable' => 0,
        ]);

        ProductMedia::insert([
            'product_id' => $pid,
            'file_type' => '',
            'size' => '',
            'media_type' => 'image',
            'purpose' => 'thumbnail',
            'url' => $image_url,
        ]);

        return redirect('/admin/products');
    }

    public function editProduct($pid) {
        $product = Product::find($pid);
        $categories = ProductCategory::get();
        $manufacturers = ProductManufacturer::get();

        if(empty($product)) {
            return redirect('/admin/products');
        }

        return view('admin.edit_product', [
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'product' => $product,
        ]);
    }


    public function updateProduct(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'manufacturer' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath, $name);
    
            $image_url =  URL('/images/products/' . $name);


            ProductMedia::where('product_id', $data['product_id'])
                            ->where('purpose', 'thumbnail')
                            ->update([
                                'url' => $image_url,
                            ]);
        }
    
        $pid = Product::where('id', $data['product_id'])
                        ->update([
                            'category_id' => $data['category'],
                            'manufacturer_id' => $data['manufacturer'],
                            'name' => $data['name'],
                            'sku' => !empty($data['sku']) ? $data['sku'] : '',
                            'short_desc' => $data['short_description'],
                            'long_desc' => $data['long_description'],
                            'price' => $data['price'],
                            'is_downloadable' => 0,
                        ]);


        return redirect('/admin/products');
    }

    public function deleteProduct($pid) {
        Product::where('id', $pid)->delete();
        ProductMedia::where('product_id', $pid)->delete();

        return redirect()->back();
    }
}
