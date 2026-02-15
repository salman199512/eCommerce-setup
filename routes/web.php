<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', [\App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('home');
Route::get('/products', [\App\Http\Controllers\Frontend\FrontendController::class, 'products'])->name('products');
Route::get('/search-suggestions', [\App\Http\Controllers\Frontend\FrontendController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/product/{slug}', [\App\Http\Controllers\Frontend\FrontendController::class, 'productDetail'])->name('products.single');

// Restored HomeController Routes
Route::get('/cms/{slug}', [\App\Http\Controllers\HomeController::class, 'cmsDetail'])->name('cms-detail');
Route::get('/faqs', [\App\Http\Controllers\HomeController::class, 'faqs'])->name('faqs');
Route::post('/save-newsletter', [\App\Http\Controllers\HomeController::class, 'saveNewsLetter'])->name('save.newsletter');
Route::post('/save-inquiry', [\App\Http\Controllers\HomeController::class, 'saveInquiry'])->name('save-inquiry');
Route::get('/contact-us', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact-us');
Route::get('/about-us', [\App\Http\Controllers\HomeController::class, 'about_us'])->name('about-us');
Route::post('run/cmd', [\App\Http\Controllers\HomeController::class, 'runCmd'])->name('run.cmd');
Route::get('cmd', [\App\Http\Controllers\HomeController::class, 'cmd'])->name('cmd');
Route::post('cart/add', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::get('cart', [\App\Http\Controllers\CartController::class, 'viewCart'])->name('cart');
Route::patch('update-cart', [\App\Http\Controllers\CartController::class, 'updateCart'])->name('update.cart');
Route::delete('remove-from-cart', [\App\Http\Controllers\CartController::class, 'removeFromCart'])->name('remove.from.cart');

Route::get('checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('checkout');
Route::post('place-order', [\App\Http\Controllers\PaymentController::class, 'placeOrder'])->name('place-order');
Route::get('/order/track', [\App\Http\Controllers\PaymentController::class, 'order_track'])->name('order.track');
Route::post('/verify-payment', [\App\Http\Controllers\PaymentController::class, 'verifyPayment'])->name('verifyPayment');



require __DIR__.'/auth.php';
require __DIR__.'/media.php';
require __DIR__.'/admin.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/my-account', [\App\Http\Controllers\MyAccountController::class, 'index'])->name('my-account');
    Route::put('/my-account/profile', [\App\Http\Controllers\MyAccountController::class, 'updateProfile'])->name('account.update');
    
    // Wishlist Routes (Points 7, 9)
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'viewWishlist'])->name('wishlist');
    Route::post('/wishlist/add', [\App\Http\Controllers\WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
    
    // My Orders Routes
    Route::get('/my-orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('my-orders');
    Route::get('/my-orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('my-orders.show');
});

