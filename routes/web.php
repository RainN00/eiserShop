<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController as ClientHomeController;
use App\Http\Controllers\client\UserController as ClientUserController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use App\Http\Controllers\client\CategoryController as ClientCategoryController;
use App\Http\Controllers\client\AjaxController as ClientAjaxController;
use App\Http\Controllers\client\CartController as ClientCartController;
use App\Http\Controllers\client\OrderController as ClientOrderController;
use App\Http\Controllers\client\CommentController as ClientCommentController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\RoleController as AdminRoleController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\OrderDetailController as AdminOrderDetailController;
use App\Http\Controllers\admin\CommentController as AdminCommentController;
use App\Http\Controllers\admin\RateController as AdminRateController;
use App\Http\Controllers\admin\PaymentController as AdminPaymentController;

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

Route::match(['get', 'post'], '/user/login', [ClientUserController::class, 'login'])->name('client.users.login');
Route::match(['get', 'post'], '/user/register', [ClientUserController::class, 'register'])->name('client.users.register');
Route::get('/logout', [ClientUserController::class, 'logout'])->name('client.users.logout');
Route::match(['get', 'post'], 'user/profile',[ClientUserController::class, 'profile'])->name('client.users.profile');
Route::get('/', [ClientHomeController::class, 'index'])->name('client.home');
Route::get('/products/{id}', [ClientProductController::class, 'index'])->name('client.product.index');
Route::post('/comments', [ClientCommentController::class, 'postComment'])->name('client.comment.post');
Route::post('/rating', [ClientProductController::class, 'postRating'])->name('client.product.rating');
Route::get('/categories', [ClientCategoryController::class, 'index'])->name('client.categories.index');
Route::get('/contact', [ClientCategoryController::class, 'index'])->name('client.contact.index');
Route::get('/categories/{id}', [ClientCategoryController::class, 'detail'])->name('client.categories.detail');
Route::get('/add-to-cart', [ClientAjaxController::class, 'addToCart'])->name('client.ajax.addToCart');
Route::get('/carts', [ClientCartController::class, 'index'])->name('client.carts.index');
Route::get('/remove-item-cart', [ClientCartController::class, 'removeItemCart'])->name('client.carts.remove');
Route::get('/minus-quantity-item', [ClientCartController::class, 'removeQuantityItem'])->name('client.carts.minus_quantity_item');
Route::get('/plus-quantity-item', [ClientCartController::class, 'addQuantityItem'])->name('client.carts.plus_quantity_item');
Route::get('/history-cart', [ClientUserController::class, 'historyCart'])->name('client.users.history.cart');
Route::match(['get', 'post'], '/checkout', [ClientOrderController::class, 'checkout'])->name('client.order.checkout');
Route::get('/order-success', [ClientOrderController::class, 'success'])->name('client.orders.success');


Route::prefix('eiser')->group(function () {
    Route::match(['get','post'], 'login', [AdminController::class, 'login'])->name('admin.user.login');
    Route::middleware(['checklogin'])->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('logout', [AdminController::class, 'logout'])->name('admin.users.logout');
        });
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('payments', AdminPaymentController::class);
        Route::resource('orders', AdminOrderController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('roles', AdminRoleController::class);
        Route::resource('comments', AdminCommentController::class);
        Route::resource('rates', AdminRateController::class);
    });
});
