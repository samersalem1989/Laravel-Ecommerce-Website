<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageUploadController;




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

// Home Page
Route::get('/', [ProductController::class, 'getProducts']); 
// Search
Route::get('search', [SearchController::class, 'search']); 
// Single Product Page
Route::get('single-product', [ProductController::class, 'singleProduct']); 
Route::get('qty-plus', [ProductController::class, 'singleQtyPlus']);  
Route::get('qty-minus', [ProductController::class, 'singleQtyMinus']);  
// All Categories 
Route::get('categories', [ProductController::class, 'categories']);  
// Single Category
Route::get('category', [ProductController::class, 'getCategory']); 
// Checkout & Thankyou
Route::get('checkout', [PayController::class, 'checkout']);
Route::post('checkout', [PayController::class, 'payOrder']);  
Route::get('thankyou', [PayController::class, 'thankyou']);
// Cart
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::get('add-single-product-to-cart', [ProductController::class, 'addSingleProductToCart'])->name('add.single.product.to.cart');
Route::patch('update-cart-plus', [ProductController::class, 'updatePlus'])->name('update.cart.plus');
Route::patch('update-cart-minus', [ProductController::class, 'updateMinus'])->name('update.cart.minus');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
// Buy Now
Route::get('buynow', [ProductController::class, 'buyNow'])->name('buynow');
Route::get('singleProductbuynow', [ProductController::class, 'singleProductbuynow'])->name('buynow.single.product');
// Authenticated User
Route::group( ['middleware' => 'auth' ], function()
{
    Route::get('profile', [UserController::class, 'getUserInfo']);
    Route::put('update-userinfo/{id}', [UserController::class, 'postUserInfo']);
    Route::get('my-orders', [UserController::class, 'userOrders']);
    Route::delete('delete-order', [UserController::class, 'removeOrder'])->name('delete.order');
    Route::post('add-review', [UserController::class, 'addReview'])->name('add.review');
});

Auth::routes();
