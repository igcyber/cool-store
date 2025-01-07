<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;


Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('admin')->group(function(){
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/dashboard', DashboardController::class)->name('admin.dashboard.index');
        Route::get('/customer', CustomerController::class)->name('admin.customer.index');
        Route::get('/profile', ProfileController::class)->name('admin.profile.index');
        Route::resource('/users', UserController::class, ['as' => 'admin'])->except('show');
        Route::resource('/categories', CategoryController::class, ['as' => 'admin'])->except('show');
        Route::resource('/sub_categories', SubCategoryController::class, ['as' => 'admin'])->except('show');
        Route::resource('/products', ProductController::class, ['as' => 'admin'])->except('show');
        Route::resource('/orders', OrderController::class, ['as' => 'admin'])->only(['index', 'show']);
        Route::resource('/sliders', SliderController::class, ['as' => 'admin'])->only(['index', 'store', 'destroy']);
        Route::resource('/settings', SettingController::class, ['as' => 'admin'])->only(['index','update']);
    });
});
