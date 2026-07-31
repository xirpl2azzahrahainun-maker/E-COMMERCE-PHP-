<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cartcontroller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
Route::get('/Admin/dashboard', [AdminController::class, 'dashboard'])
     ->name('Admin.dashboard');
Route::get('/Admin/sales', [AdminController::class, 'salesReport'])
     ->name('Admin.sales');
Route::get('/Admin/Orders', [AdminOrderController::class, 'index'])
     ->name('Admin.Orders.index');
Route::get('/Admin/Orders/{id}', [AdminOrderController::class, 'show'])
     ->name('Admin.Orders.show');
 Route::PUT('/Admin/Orders/{id}', [AdminOrderController::class, 'update'])
     ->name('Admin.Orders.update');

Route::resource('/product', ProductController::class);


Route::get('/customer/dashboard', [CustomerController::class, 'dashboardcus'])
    ->name('customer.dashboardcus');

Route::get('/customer/product', [CustomerController::class, 'productcus'])
    ->name('customer.productcus');

Route::get('/customer/cart', [Cartcontroller::class, 'index'])
    ->name('customer.cart');

Route::POST('/customer/cart/add/{productId}', [Cartcontroller::class, 'add'])
    ->name('customer.cart.add');

    Route::PUT('/customer/cart/update/{cartId}', [Cartcontroller::class, 'update'])
    ->name('customer.cart.update');

Route::delete('/customer/cart/remove/{cartId}', [Cartcontroller::class, 'remove'])
    ->name('customer.cart.remove');

Route::get('/checkout', [OrderController::class, 'checkout'])
    ->name('customer.checkout');

Route::post('/checkout/process', [OrderController::class, 'processCheckout'])
    ->name('customer.checkout.process');

Route::get('/customer/order/confirmation/{orderId}', [OrderController::class, 'Konfirmasi'])
    ->name('customer.order.confirmation');

route::get('/orders', [OrderController::class, 'orders'])->name('customer.orders');
route::get('/orders/{orderId}', [OrderController::class, 'orderDetails'])->name('customer.order.show');







