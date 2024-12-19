<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('admin')->group(function(){
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/dashboard', DashboardController::class)->name('admin.dashboard.index');

        Route::resource('/categories', CategoryController::class, ['as' => 'admin'])->except('show');
        Route::resource('/products', ProductController::class, ['as' => 'admin'])->except('show');
    });
});
