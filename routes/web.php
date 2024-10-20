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
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ShippingController;
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

Route::get('/shop',[IndexController::class, 'shop'])->name('shop');
Route::post('/shop-filter',[IndexController::class, 'shopFilter'])->name('shop.filter');
//admin dashboard

Route::group(['prefix'=>'admin', 'middleware'=> ['auth','admin']],function(){
    Route::get('/', [AdminController::class,'admin'])->name('admin');
    Route::resources([
        'banner' => BannerController::class,
       'category' => CategoryController::class,
       'brand' => BrandController::class,
       'product' => ProductController::class,
       'user' => UserController::class,
       'coupon' => CouponController::class,
       'shipping' => ShippingController::class
    ]);
    Route::post('banner_status',[BannerController::class, 'bannerStatus'])->name('banner.status');
    Route::post('category_status',[CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::post('category/{id}/child',[CategoryController::class,'getChidByParentId']);
    Route::post('brand_status',[BrandController::class, 'brandStatus'])->name('brand.status');
    Route::post('product_status',[ProductController::class, 'productStatus'])->name('product.status');
    Route::post('user_status',[UserController::class, 'userStatus'])->name('user.status');
    Route::post('coupon_status',[CouponController::class, 'couponStatus'])->name('coupon.status');
    Route::post('coupon/add',[CouponController::class, 'couponAdd'])->name('coupon.add');
    Route::post('shipping_status',[ShippingController::class, 'shippingStatus'])->name('shipping.status');
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
    Route::post('wishlist/move-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move.cart');
    Route::post('wishlist/delete', [WishlistController::class, 'wishlistDelete'])->name('wishlist.delete');
    Route::get('checkout1',[CheckoutController::class, 'checkout1'])->name('checkout1')->middleware('user');
    Route::post('checkout-first',[CheckoutController::class, 'checkout1Store'])->name('checkout1.store');
    Route::post('checkout-second',[CheckoutController::class, 'checkout2Store'])->name('checkout2.store');
    Route::post('checkout-third',[CheckoutController::class, 'checkout3Store'])->name('checkout3.store');
    Route::get('checkout-store',[CheckoutController::class, 'checkout'])->name('checkout.store');
    Route::get('checkout-complete/{order}',[CheckoutController::class, 'complete'])->name('complete');
});