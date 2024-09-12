<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\CouponController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[IndexController::class, 'home'])->name('index');

//product category
Route::get('/product-cat/{slug}', [IndexController::class, 'productCategory'])->name('product_category');
Route::get('/product-details/{slug}', [IndexController::class, 'productDetails'])->name('product.details');
//user authentication
Route::get('/user-auth', [IndexController::class, 'userAuth'])->name('user.auth');
Route::post('/user-login', [IndexController::class, 'loginSubmit'])->name('login.submit');
Route::post('/user-register', [IndexController::class, 'registerSubmit'])->name('register.submit');
Route::get('/user-logout', [IndexController::class, 'userLogout'])->name('user.logout');
Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin dashboard

Route::group(['prefix'=>'admin', 'middleware'=> ['auth','admin']],function(){
    Route::get('/', [AdminController::class,'admin'])->name('admin');
    Route::resources([
        'banner' => BannerController::class,
       'category' => CategoryController::class,
       'brand' => BrandController::class,
       'product' => ProductController::class,
       'user' => UserController::class,
       'coupon' => CouponController::class
    ]);
    Route::post('banner_status',[BannerController::class, 'bannerStatus'])->name('banner.status');
    Route::post('category_status',[CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::post('category/{id}/child',[CategoryController::class,'getChidByParentId']);
    Route::post('brand_status',[BrandController::class, 'brandStatus'])->name('brand.status');
    Route::post('product_status',[ProductController::class, 'productStatus'])->name('product.status');
    Route::post('user_status',[UserController::class, 'userStatus'])->name('user.status');
    Route::post('coupon_status',[CouponController::class, 'couponStatus'])->name('coupon.status');
    Route::post('coupon/add',[CouponController::class, 'couponAdd'])->name('coupon.add');

});


//vendor dashboard
Route::group(['prefix'=>'vendor', 'middleware'=> ['auth','vendor']],function(){
    Route::get('/', [AdminController::class,'admin'])->name('vendor');
});

//user DASHBOARD
Route::group(['prefix'=>'user'], function(){
    Route::get('dashboard', [IndexController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('order', [IndexController::class, 'userOrder'])->name('user.order');
    Route::get('address', [IndexController::class, 'userAddress'])->name('user.address');
    Route::get('account-details', [IndexController::class, 'userAccount'])->name('user.account');

    Route::post('billing-address/{id}', [IndexController::class, 'billingAddress'])->name('billing.address');
    Route::post('shipping-address/{id}', [IndexController::class, 'shippingAddress'])->name('shipping.address');
    Route::post('update-account/{id}', [IndexController::class, 'updateAccount'])->name('account.update');
    Route::get('cart',[CartController::class, 'cart'])->name('cart');
    Route::post('cart/store',[CartController::class, 'cartStore'])->name('cart.store');
    Route::post('cart/delete',[CartController::class, 'cartDelete'])->name('cart.delete');
    Route::post('cart/update',[CartController::class, 'cartUpdate'])->name('cart.update');
    Route::get('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
    Route::post('wishlist/store', [WishlistController::class, 'wishlistStore'])->name('wishlist.store');
});