<?php

use Illuminate\Support\Facades\Route;

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
Route::redirect('/', 'user/login')->name('user.login');


//AUTH ROUTES

//ADMIN

    Route::prefix('admin/')->group(function () {
        Route::get('login', 'Auth\AuthController@adminLogin')->name('admin.login');
        Route::post('doAdminLogin', 'Auth\AuthController@doAdminLogin')->name('doAdmin.login');
    });

//USER

    Route::prefix('user/')->group(function () {
        Route::get('login', 'Auth\AuthController@userLogin')->name('user.login');
        Route::post('doUserLogin', 'Auth\AuthController@doUserLogin')->name('doUser.login');
    });


//DASHBOARD

//ADMIN

    Route::prefix('admin/')->group(function () {
        Route::get('dashboard', 'Admin\Dashboard\DashboardController@adminDashboard')->name('admin.dashboard');
    });

//USER

    Route::prefix('user/')->group(function () {
        Route::get('dashboard', 'User\Dashboard\DashboardController@userDashboard')->name('user.dashboard');
    });



Route::get('register', 'Auth\RegisterController@register')->name('register');
