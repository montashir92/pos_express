<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [PageController::class, 'index']);

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Users Routes
    Route::controller(UsersController::class)->group(function () {
        Route::get('/all-users', 'index')->name('users.index');
        Route::post('/store/user', 'store')->name('user.store');
        Route::get('/edit/user/{id}', 'edit')->name('user.edit');
        Route::post('/update/user/{id}', 'update')->name('user.update');
        Route::post('/user/delete', 'delete')->name('user.delete');
    });

    // Users Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profiles', 'index')->name('users.profiles');
        Route::get('/profile/edit', 'edit')->name('user.profile.edit');
        Route::post('/profile/update/', 'update')->name('user.profile.update');
        Route::get('/profile/change-password', 'editPassword')->name('user.change.password');
        Route::post('/profile/update-password', 'updatePassword')->name('user.update.password');
    });

    // Supplier Routes
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('admin.suppliers');
        Route::post('/supplier/store', 'store')->name('admin.supplier.store');
        Route::get('/supplier/edit/{id}', 'edit')->name('admin.supplier.edit');
        Route::post('/supplier/update/{id}', 'update')->name('admin.supplier.update');
        Route::post('/supplier/delete', 'delete')->name('admin.supplier.delete');
    });

    // Unit Routes
    Route::controller(UnitController::class)->group(function () {
        Route::get('/units', 'index')->name('admin.units');
        Route::post('/unit/store', 'store')->name('admin.unit.store');
        Route::get('/unit/edit/{id}', 'edit')->name('admin.unit.edit');
        Route::post('/unit/update/{id}', 'update')->name('admin.unit.update');
        Route::post('/unit/delete', 'delete')->name('admin.unit.delete');
    });

    // Category Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('admin.categories');
        Route::post('/category/store', 'store')->name('admin.category.store');
        Route::get('/category/edit/{id}', 'edit')->name('admin.category.edit');
        Route::post('/category/update/{id}', 'update')->name('admin.category.update');
        Route::post('/category/delete', 'delete')->name('admin.category.delete');
    });

    // Customer Routes
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'index')->name('admin.customers');
        Route::post('/customer/store', 'store')->name('admin.customer.store');
        Route::get('/customer/edit/{id}', 'edit')->name('admin.customer.edit');
        Route::post('/customer/update/{id}', 'update')->name('admin.customer.update');
        Route::post('/customer/delete', 'delete')->name('admin.customer.delete');
    });

    // Product Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.products');
        Route::get('/product/create', 'create')->name('admin.product.create');
        Route::post('/product/store', 'store')->name('admin.product.store');
        Route::get('/product/edit/{id}', 'edit')->name('admin.product.edit');
        Route::post('/product/update/{id}', 'update')->name('admin.product.update');
        Route::post('/product/delete', 'delete')->name('admin.product.delete');
    });
    
    

});
