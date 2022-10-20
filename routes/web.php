<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\UploadThumbController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Homepage\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Homepage\ClientNewsController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Homepage\ContactController;
use App\Http\Controllers\Homepage\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    Route::get('/', [HomeController::class, 'index']);
    Route::get('products/{product}/product-detail', [HomeController::class, 'show'])->name('product-detail');
    Route::get('products/{product_id}/comments/create', [HomeController::class, 'createComment']);
    Route::get('products/{product_id}/comments/edit', [HomeController::class, 'editComment']);
    Route::get('products/{product_id}/comments/delete', [HomeController::class, 'deleteComment']);
    Route::get('products/{product_id}/comments/like', [HomeController::class, 'likeComment']);

    Route::get('products/{product}/edit-comment/{id}', [HomeController::class, 'editCmt'])->name('rep-comment');
    Route::put('products/{product}/rep-comments/{id}', [HomeController::class, 'updateCmt']);

    Route::post('reaction', [HomeController::class, 'react'])->name('react-cmt');

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

    Route::post('/contact-us', [ContactController::class, "store"]);

    Route::get('/faq', function () {
        return view('client.faq');
    });

    Route::get('/list-products', function () {
        return view('client.list-products');
    });

    Route::get('/news', [ClientNewsController::class, 'index'])->name('news');

    Route::get('/news-detail/{id}', [ClientNewsController::class, 'show'])->name('news-detail');

    Route::get('/login', function () {
        return view('client.login');
    });

    Route::get('/logout', function () {
        Session::forget('user_name');
        return back();
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
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

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

    Route::get('/verification', function () {
        return view('client.verification');
    });
});

// Admin
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::prefix('product')->group(function () {
        Route::get('active', [ProductController::class, 'changeActive']);
        Route::get('delete-all-page', [ProductController::class, 'deleteAllPage']);
    });
    // Danh mục
    Route::resource('menus', MenuController::class);

    // News
    Route::resource('news', NewsController::class);

    // news
    Route::resource('news', NewsController::class);

    // users
    Route::resource('users', UserController::class);
    // Vouchers
    Route::resource('vouchers', VoucherController::class);

    //Staff
    Route::resource('staffs', StaffController::class);

    //upload thumb
    Route::post('/upload/services', [UploadThumbController::class, 'store']);

    //Slides
    Route::resource('slides', SlideController::class);
    Route::prefix('slide')->group(function () {
        Route::get('active', [SlideController::class, 'changeActive']);
    });

    //Contact
<<<<<<< HEAD
    Route::get('contacts', [AdminContactController::class, 'index'])->name('admin.contacts-index');
=======
    Route::get('contacts', [AdminContactController::class , 'index'])->name('admin.contacts-index');

    //Price
    Route::resource('prices', PriceController::class);
});
>>>>>>> thuy

    //Comment
    Route::resource('comments', CommentController::class);
    Route::prefix('comment')->group(function () {
        Route::get('active', [CommentController::class, 'changeActive']);
    });
});

//login with google
Route::get('/auth/google/redirect', [AuthController::class, 'googleredirect']);
Route::get('/auth/google/callback', [AuthController::class, 'googlecallback']);