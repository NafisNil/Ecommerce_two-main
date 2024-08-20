<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\frontend\IndexController;
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

Route::get('/',[IndexController::class, 'home'])->name('home');
//product category
Route::get('/product-cat/{slug}', [IndexController::class, 'productCategory'])->name('product_category');

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin dashboard

Route::group(['prefix'=>'admin', 'middleware'=> 'auth'],function(){
    Route::get('/', [AdminController::class,'admin'])->name('admin');
    Route::resources([
        'banner' => BannerController::class,
       'category' => CategoryController::class,
       'brand' => BrandController::class,
       'product' => ProductController::class,
       'user' => UserController::class
    ]);
    Route::post('banner_status',[BannerController::class, 'bannerStatus'])->name('banner.status');
    Route::post('category_status',[CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::post('category/{id}/child',[CategoryController::class,'getChidByParentId']);
    Route::post('brand_status',[BrandController::class, 'brandStatus'])->name('brand.status');
    Route::post('product_status',[ProductController::class, 'productStatus'])->name('product.status');
    Route::post('user_status',[UserController::class, 'userStatus'])->name('user.status');
});
