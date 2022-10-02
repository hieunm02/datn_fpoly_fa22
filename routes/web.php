<?php

use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadThumbController;
use Illuminate\Support\Facades\Route;

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

// Client
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return view('client.index');
    });

    Route::get('/checkout', function () {
        return view('client.checkout');
    });

    Route::get('/coming-soon', function () {
        return view('errors.coming-soon');
    });

    Route::get('/maintence', function () {
        return view('errors.maintence');
    });

    Route::get('/contact-us', function () {
        return view('client.contact-us');
    });

    Route::get('/faq', function () {
        return view('client.faq');
    });

    Route::get('/list-products', function () {
        return view('client.list-products');
    });

    Route::get('/news', function () {
        return view('client.news');
    });

    Route::get('/news-detail', function () {
        return view('client.news-detail');
    });

    Route::get('/login', function () {
        return view('client.login');
    });

    Route::get('/my-order', function () {
        return view('client.my-order');
    });

    Route::get('/offers', function () {
        return view('client.offers');
    });

    Route::get('/privacy', function () {
        return view('client.privacy');
    });

    Route::get('/profile', function () {
        return view('client.profile');
    });

    Route::get('/search', function () {
        return view('client.search');
    });

    Route::get('/status', function () {
        return view('client.status');
    });

    Route::get('/successful', function () {
        return view('client.successful');
    });

    Route::get('/term', function () {
        return view('client.term');
    });

    Route::get('/product-detail', function () {
        return view('client.product-detail');
    });

    Route::get('/verification', function () {
        return view('client.verification');
    });
});

// Admin
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);

    // Danh mục
    Route::resource('menus', MenuController::class);
    Route::resource('news', NewsController::class);

    // news
    Route::resource('news', NewsController::class);

    //upload thumb
    Route::post('upload/services', [UploadThumbController::class, 'store']);
});