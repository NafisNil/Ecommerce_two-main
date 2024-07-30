<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin dashboard

Route::group(['prefix'=>'admin', 'middleware'=> 'auth'],function(){
    Route::get('/', [AdminController::class,'admin'])->name('admin');
    Route::resources([
        'banner' => BannerController::class,
       'category' => CategoryController::class
    ]);
    Route::post('banner_status',[BannerController::class, 'bannerStatus'])->name('banner.status');
    Route::post('category_status',[CategoryController::class, 'categoryStatus'])->name('category.status');
});
