<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/products/{id}/{slug}', [ShopController::class, 'productDetails']);
Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CartController::class, 'checkout']);
Route::post('/checkout/submit', [CartController::class, 'submitCheckout']);
Route::get('/cart/add-now/{id}/{type}', [CartController::class, 'addToCartNow']);
Route::get('/cart/remove/{item_id}', [CartController::class, 'removeFromCart']);
Route::get('/cart/remove/{id}', [CartController::class, 'removeCartItem']);
Route::get('/checkout/success/{order_id}', [CartController::class, 'checkoutSuccess']);



Route::group(['middleware' => ['auth']], function() {
    Route::get('/my-account', [UserController::class, 'myAccount']);
    Route::post('/my-account/update-info', [UserController::class, 'updateInfo']);
    Route::get('/my-account/shipping-address', [UserController::class, 'shipping']);
    Route::post('/my-account/shipping-address/submit', [UserController::class, 'updateShippingAddress']);
    Route::get('/my-account/my-orders', [UserController::class, 'myOrders']);

    Route::get('/admin/products', [ProductController::class, 'index']);
    Route::get('/admin/orders', [OrderController::class, 'index']);
    Route::get('/admin/products/new', [ProductController::class, 'newProduct']);
    Route::post('/admin/products/new', [ProductController::class, 'addProduct']);
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'editProduct']);
    Route::post('/admin/products/edit', [ProductController::class, 'updateProduct']);
    Route::get('/admin/products/{id}/delete', [ProductController::class, 'deleteProduct']);

    Route::get('/logout', [UserController::class, 'logout']);
 });
