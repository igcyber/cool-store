<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('api.customer.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.customer.register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'getUser'])->name('api.customer.user');

    Route::get('/order', [OrderController::class, 'index'])->name('api.order.index');
    Route::get('/order/{snap_token?}', [OrderController::class, 'show'])->name('api.order.show');

    Route::get('/carts', [CartController::class, 'index'])->name('customer.cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('customer.cart.store');
    Route::get('/cart/total-price', [CartController::class, 'getPriceTotal'])->name('customer.cart.totalPrice');
    Route::get('/cart/total-weight', [CartController::class, 'getWeightTotal'])->name('customer.cart.totalWeight');
    Route::post('/cart/remove-item', [CartController::class, 'removeItem'])->name('customer.cart.removeItem');
    Route::post('cart/remove-all-item', [CartController::class, 'removeAllItem'])->name('customer.cart.removeAllItem');

    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

});

Route::get('/categories', [CategoryController::class, 'index'])->name('customer.category.index');
Route::get('/category/{slug?}', [CategoryController::class,'show'])->name('customer.category.show');
Route::get('/categoryHeader', [CategoryController::class, 'categoryHeader'])->name('customer.category.header');

Route::get('/sub_categories', [SubCategoryController::class, 'index'])->name('customer.sub_category.index');
Route::get('/sub_category/{slug?}', [SubCategoryController::class,'show'])->name('customer.sub_category.show');
Route::get('/sub_categoryHeader', [SubCategoryController::class, 'subCategoryHeader'])->name('customer.sub_category.header');

Route::get('/products', [ProductController::class, 'index'])->name('customer.product.index');
Route::get('/product/{slug?}', [ProductController::class, 'show'])->name('customer.product.show');

Route::get('/rajaongkir/provinces', [RajaOngkirController::class, 'getProvinces'])->name('customer.rajaongkir.provinces');
Route::get('/rajaongkir/cities', [RajaOngkirController::class, 'getCities'])->name('customer.rajaongkir.cities');
Route::post('/rajaongkir/cek-ongkir', [RajaOngkirController::class, 'cekOngkir'])->name('customer.rajaongkir.cekOngkir');

Route::post('/notificationHandler', [CheckoutController::class, 'notificationHandler'])->name('notificationHandler');

Route::get('/sliders', SliderController::class)->name('customer.slider.index');

Route::get('/setting', SettingController::class)->name('customer.setting.index');
