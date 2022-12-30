<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Crud\RoleController;
use App\Http\Controllers\Crud\UserController;
use App\Http\Controllers\Crud\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('api')->prefix('/v1')->group(function () {
    //Auth
    Route::controller(AuthController::class)->prefix('/auth')->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::get('/me', 'me')->name('me');
    });

    Route::middleware('jwt.auth')->group(function () {
        Route::resource('roles', RoleController::class, ['as' => 'crud']);
        Route::resource('users', UserController::class, ['as' => 'crud',]);
        Route::resource('posts', PostController::class, ['except' => ['create'], 'as' => 'crud']);
    });


});
