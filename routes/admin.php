<?php

use EcommerceCourse\Http\Controllers\Dashboard\HomeController;
use EcommerceCourse\Http\Controllers\Dashboard\AuthController;
use EcommerceCourse\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/admin',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::group([
        'namespace' => 'Dashboard',
        'middleware' => 'auth:admin',
    ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('admin.home');
        Route::group(['prefix' => '/settings'], function () {
            Route::get('/shipping/{type}', [SettingsController::class, 'editShipping'])->name('edit.shipping.methods');
            Route::put('/shipping/{type}', [SettingsController::class, 'saveShipping'])->name('save.shipping.methods');
        });
    });

    Route::group(['middleware' => 'guest:admin,web'], function () {
        Route::get('/login', [AuthController::class, 'viewLogin'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login']);
    });
    Route::get('/logout', [AuthController::class, 'logout']);
});

