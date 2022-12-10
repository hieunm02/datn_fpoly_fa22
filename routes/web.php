<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NotifyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\OptionDetailController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RepMessage;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\UploadThumbController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Homepage\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Homepage\ClientNewsController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Homepage\BillController as HomepageBillController;
use App\Http\Controllers\Homepage\CartController;
use App\Http\Controllers\Homepage\ContactController;
use App\Http\Controllers\Homepage\ListProductController;
use App\Http\Controllers\Homepage\OrderController as HomepageOrderController;
use App\Http\Controllers\Homepage\OrderGroupController;
use App\Http\Controllers\Homepage\ProfileController;
use App\Http\Controllers\SendMessage;
use App\Http\Controllers\Homepage\VoucherController as HomepageVoucherController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/carts/getFloor', [CartController::class, 'getFloor']);
    Route::get('/carts/getRoom', [CartController::class, 'getRoom']);
    Route::put('/carts/update/{id}', [CartController::class, 'update']);
    Route::post('storeCart', [CartController::class, 'store'])->name('carts.store');
    Route::delete('/carts/delete/{id}', [CartController::class, 'destroy']);
    //bill
    Route::get('bills', [HomepageBillController::class, 'getBill'])->name('bills');
    Route::get('bill/{code}', [HomepageBillController::class, 'getBillCode'])->name('billDetail');
    Route::post('bill/change/{status}', [HomepageBillController::class, 'changstatus'])->name('changstatus');
    //end bill
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('products/{product}/product-detail', [HomeController::class, 'show'])->name('product-detail');
    Route::get('products/{product_id}/comments/create', [HomeController::class, 'createComment']);
    Route::get('products/{product_id}/comments/edit', [HomeController::class, 'editComment']);
    Route::get('products/{product_id}/comments/delete', [HomeController::class, 'deleteComment']);
    Route::get('products/{product_id}/comments/like', [HomeController::class, 'likeComment']);

    Route::get('products/{product}/edit-comment/{id}', [HomeController::class, 'editCmt'])->name('rep-comment');
    Route::put('products/{product}/rep-comments/{id}', [HomeController::class, 'updateCmt']);

    Route::post('reaction', [HomeController::class, 'react'])->name('react-cmt');

    Route::resource('carts', CartController::class);

    Route::resource('orders', HomepageOrderController::class);
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

    //ListProducts
    Route::get('/list-products', [ListProductController::class, 'getList'])->name('listProducts');
    Route::get('/list-products/{id}', [ListProductController::class, 'getListMenu'])->name('list-products');

    Route::get('/news', [ClientNewsController::class, 'index'])->name('news');

    Route::get('/news-detail/{id}', [ClientNewsController::class, 'show'])->name('news-detail');

    //Login - Logout
    Route::post('/login', [AuthController::class, 'handleLogin']);
    Route::get('/login', function () {
        return view('client.login');
    })->name('login');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route("index");
    });

    Route::get('/my-order', function () {
        return view('client.my-order');
    });

    Route::get('/offers', [HomepageVoucherController::class, 'index'])->name('offers');

    Route::get('/privacy', function () {
        return view('client.privacy');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::get('/search', function () {
        return view('client.search');
    });

    Route::get('/search/client', [HomeController::class, 'search']);
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

    Route::post('/vouchers/exchange', [HomepageVoucherController::class, 'exchangeVoucher'])->name('vouchers.exchange');

    //đặt hàng nhóm
    Route::get('order-group/{code?}', [OrderGroupController::class, 'getProducts']);
    // xem nhanh thông tin sản phẩm 
    Route::post('quickview', [OrderGroupController::class, 'quickview'])->name('quickview');
    // tạo nhóm 
    Route::post('order-group', [OrderGroupController::class, 'createGroup'])->name('order-group');

    //thêm sản phẩm vào giỏ hàng
    Route::post('order-group-add-cart', [OrderGroupController::class, 'addToCart'])->name('order-group-add-cart');
    Route::post('order-group-checkout', [OrderGroupController::class, 'checkOut'])->name('order-group-checkout');


});

// Admin
// ->middleware('role:admin')
Route::prefix('admin')->middleware('role:manager|staff')->group(function () {

    //dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/dashboard-filter', [DashboardController::class, 'filter']);
    Route::post('/dashboard-filterday', [DashboardController::class, 'filterday']);
    //thanh toán trực tiếp tại quầy
    Route::get('/thanh-toan-truc-tiep/getCart', [OrderController::class, 'getCart']);
    Route::get('/thanh-toan-truc-tiep', [OrderController::class, 'payment'])->name('admin.thanh-toan-truc-tiep');
    Route::post('/thanh-toan-truc-tiep', [OrderController::class, 'directPayment']);
    Route::post('/thanh-toan-truc-tiep/paymanet', [OrderController::class, 'pay']);
    Route::delete('/thanh-toan-truc-tiep/deleteCartOrder/{order_tt}', [OrderController::class, 'deleteCartOrder'])->name('delete.cart_tt');

    //sản phẩm
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::prefix('product')->group(function () {
        Route::get('active', [ProductController::class, 'changeActive']);
        Route::get('delete-all-page', [ProductController::class, 'deleteAllPage']);
        Route::get('option-details', [ProductController::class, 'getOptionDetails']);
        Route::get('product-option-details', [ProductController::class, 'getProductOptionDetails']);
    });
    // Danh mục
    Route::resource('menus', MenuController::class);
    Route::prefix('menu')->group(function () {
        Route::get('active', [MenuController::class, 'changeActive']);
    });

    // News
    Route::resource('news', NewsController::class);
    Route::prefix('new')->group(function () {
        Route::get('active', [NewsController::class, 'changeActive']);
    });

    // users
    Route::resource('users', UserController::class);
    Route::prefix('user')->group(function () {
        Route::get('active', [UserController::class, 'changeActive']);
    });

    // Vouchers
    Route::resource('vouchers', VoucherController::class);
    Route::prefix('voucher')->group(function () {
        Route::get('active', [VoucherController::class, 'changeActive']);
    });
    //Staff
    Route::middleware('role:manager')->resource('staffs', StaffController::class);

    //upload thumb
    Route::post('/upload/services', [UploadThumbController::class, 'store']);

    //Slides
    Route::resource('slides', SlideController::class);
    Route::prefix('slide')->group(function () {
        Route::get('active', [SlideController::class, 'changeActive']);
    });

    //Contact
    Route::get('contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('contacts/{id}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::post('send-email', [AdminContactController::class, 'sendMail'])->name('admin.contacts.send-mail');

    //Chat
    Route::get('chats/message/{room_id?}', [ChatController::class, 'message'])->name('admin.chats.message');
    Route::get('chats/message', [ChatController::class, 'message'])->name('admin.chats.message');

    //Price
    Route::resource('prices', PriceController::class);

    //Comment
    Route::resource('comments', CommentController::class);
    Route::prefix('comment')->group(function () {
        Route::get('active', [CommentController::class, 'changeActive']);
    });

    //Bill
    Route::resource('bills', BillController::class);
    //Address Building Floor Room
    Route::prefix('address')->group(function () {
        //Building
        Route::get('buildings', [AddressController::class, 'getBuildings'])->name('building.index');
        Route::get('buildings/create', [AddressController::class, 'createBuilding'])->name('building.create');
        Route::post('buildings/create', [AddressController::class, 'storeBuilding'])->name('building.store');
        Route::get('buildings/update/{id}', [AddressController::class, 'editBuilding'])->name('building.edit');
        Route::put('buildings/update/{id}', [AddressController::class, 'updateBuilding'])->name('building.update');
        Route::delete('buildings/delete/{id}', [AddressController::class, 'destroyBuilding'])->name('building.destroy');
        //Floor
        Route::get('buildings/{id}', [AddressController::class, 'getFloorsBuilding'])->name('building.floors');
        Route::get('buildings/floors/create/{id}', [AddressController::class, 'createFloor'])->name('floor.create');
        Route::post('buildings/floors/create/unique', [AddressController::class, 'uniqueFloor']);
        Route::post('buildings/floors/create', [AddressController::class, 'storeFloor'])->name('floor.store');
        Route::get('buildings/floors/update/{id}', [AddressController::class, 'editFloor'])->name('floor.edit');
        Route::put('buildings/floors/update/{id}', [AddressController::class, 'updateFloor'])->name('floor.update');
        Route::delete('buildings/floors/delete/{id}', [AddressController::class, 'destroyFloor'])->name('floor.destroy');
        //Room
        Route::get('buildings/floors/{id}', [AddressController::class, 'getRoomsFloor'])->name('floor.rooms');
        Route::get('buildings/floors/rooms/create/{id}', [AddressController::class, 'createRoom'])->name('room.create');
        Route::post('buildings/floors/rooms/create', [AddressController::class, 'storeRoom'])->name('room.store');
        Route::get('buildings/floors/rooms/update/{id}', [AddressController::class, 'editRoom'])->name('room.edit');
        Route::put('buildings/floors/rooms/update/{id}', [AddressController::class, 'updateRoom'])->name('room.update');
        Route::delete('buildings/floors/rooms/delete/{id}', [AddressController::class, 'destroy'])->name('room.delete');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/search/code', [OrderController::class, 'searchByCode'])->name('orders.searchCode');
        Route::get('/search/status', [OrderController::class, 'searchByStatus'])->name('orders.searchStatus');
        Route::put('/update-status', [OrderController::class, 'updateStatus']);
        Route::get('/orderDetails/{id}', [OrderController::class, 'getOrderDetails']);
        // Route::put('/change-status', [OrderController::class, 'changeStatus']);)
    });

    Route::resource('/options', OptionController::class);
    Route::resource('/option-details', OptionDetailController::class);
});

Route::resource('notifies', NotifyController::class);




//login with google
Route::get('/auth/google/redirect', [AuthController::class, 'googleredirect']);
Route::get('/auth/google/callback', [AuthController::class, 'googlecallback']);

// Người dùng nhắn tin
Route::post('/send', [SendMessage::class, 'sendMessage'])->name('send');

// Nhân viên phản hồi tin nhắn tới người dùng
Route::post('/rep', [RepMessage::class, 'repMessage'])->name('rep');

// xuất file
Route::get('export/{order}', [ExportController::class, 'export'])->name('export');
