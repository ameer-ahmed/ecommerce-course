<?php

use EcommerceCourse\Http\Controllers\Dashboard\HomeController;
use EcommerceCourse\Http\Controllers\Dashboard\LoginController;
use Illuminate\Support\Facades\Route;

/**
 * NOTE: A prefix '/admin' was added in RouteServiceProvider.
 */

Route::group([
    'namespace' => 'Dashboard',
    'middleware' => 'auth:admin',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');
});

Route::group(['middleware' => 'guest:admin,web'], function () {
    Route::get('/login', [LoginController::class, 'viewLogin'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::get('/logout', [LoginController::class, 'logout']);

