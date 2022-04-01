<?php

use App\Http\Controllers\API\GetDataController;
use App\Http\Controllers\API\PostsAPIController;
use App\Http\Controllers\API\SubscriptionsAPIController;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# API VERSION 1 ROUTES

Route::prefix('v1')->name('api.v1.')->group(function() {
    # Routes to get all data present in the app
    Route::prefix('getdata')->name('getdata.')->group(function() {
        Route::get('/users', [GetDataController::class, 'users'])->name('users');
        Route::get('/posts', [GetDataController::class, 'posts'])->name('posts');
        Route::get('/websites', [GetDataController::class, 'websites'])->name('websites');
        Route::get('/subscriptions', [GetDataController::class, 'subscriptions'])->name('subscriptions');
    });

    # Subscriptions
    Route::prefix('subscriptions')->name('subscriptions')->group(function() {
        Route::get('/all', [SubscriptionsAPIController::class, 'all'])->name('all');
        Route::post('/subscribe/{user}/{website}', [SubscriptionsAPIController::class, 'subscribe'])->name('subscribe');
    });

    # Posts
    Route::prefix('posts')->name('posts')->group(function() {
        Route::post('/create/{website:id}', [PostsAPIController::class, 'create'])->name('create');
    });


     # A simple callback function.
     Route::get('/', function() {
        return response()->json(
            config('app.name').', API '. RouteServiceProvider::API_VERSION.'. Please refer the README.md file for instructions on how to use this demo app'
        );
    })->name('index');
});


# API Base route, redirects to /v1
Route::get('/', function() {
    return redirect()->route('api.v1.index');
});

