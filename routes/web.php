<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
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
    

});
