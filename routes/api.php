<?php

use App\Http\Controllers\API\GetDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# API VERSION 1 ROUTES

Route::prefix('v1')->name('api.v1.')->group(function() {


    # Routes to get all data present in the app
    Route::prefix('getdata')->name('getdata.')->group(function() {
        Route::get('/users', [GetDataController::class, 'users'])->name('users');
        Route::get('/posts', [GetDataController::class, 'posts'])->name('posts');
        Route::get('/subscriptions', [GetDataController::class, 'subscriptions'])->name('subscriptions');
    });



});
