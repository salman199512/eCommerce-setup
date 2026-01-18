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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cms/{slug}', [\App\Http\Controllers\HomeController::class, 'cmsDetail'])->name('cms-detail');
Route::get('/faqs', [\App\Http\Controllers\HomeController::class, 'faqs'])->name('faqs');
Route::post('/save-newsletter', [\App\Http\Controllers\HomeController::class, 'saveNewsLetter'])->name('save.newsletter');
Route::post('/save-inquiry', [\App\Http\Controllers\HomeController::class, 'saveInquiry'])->name('save-inquiry');
Route::get('/contact-us', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact-us');
Route::get('/about-us', [\App\Http\Controllers\HomeController::class, 'about_us'])->name('about-us');
Route::get('/products', [\App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('/product/{slug}', [\App\Http\Controllers\HomeController::class, 'productDetail'])->name('products.single');
Route::post('run/cmd', [\App\Http\Controllers\HomeController::class, 'runCmd'])->name('run.cmd');
Route::get('cmd', [\App\Http\Controllers\HomeController::class, 'cmd'])->name('cmd');
Route::post('add-to-cart', [\App\Http\Controllers\HomeController::class, 'addToCart'])->name('add-to-cart');
Route::get('checkout', [\App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::post('place-order', [\App\Http\Controllers\PaymentController::class, 'placeOrder'])->name('place-order');
Route::get('/order/track', [\App\Http\Controllers\PaymentController::class, 'order_track'])->name('order.track');


Route::post('/create-order', [\App\Http\Controllers\PaymentController::class, 'createOrder'])->name('createOrder');
Route::post('/verify-payment', [\App\Http\Controllers\PaymentController::class, 'verifyPayment'])->name('verifyPayment');
Route::post('/webhook', [\App\Http\Controllers\PaymentController::class, 'handleWebhook'])->name('handleWebhook');
//Route::get('/checkout', function () {
//    return view('checkout');
//});


require __DIR__.'/auth.php';
require __DIR__.'/media.php';
require __DIR__.'/admin.php';



