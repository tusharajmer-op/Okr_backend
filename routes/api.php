<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginSignUpController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','App\Http\Controllers\loginSignUpController@login');
Route::middleware(['token','check.admin'])->group(function () {
    Route::group(['prefix' => 'department'], function () {
        Route::controller(DepartmentController::class)->group(function () {

            Route::post('/','store');
            Route::put('/{id}','update');
            Route::delete('/{id}','destroy');
        });
    });
    Route::group(['prefix' => 'role'], function () {
        Route::controller(RoleController::class)->group(function () {

            Route::post('/','store');
            Route::put('/{id}','update');
            Route::delete('/{id}','destroy');
        });
    });
    Route::group(['prefix' => 'job'], function () {
        Route::controller(JobController::class)->group(function () {
            Route::post('/','store');
            Route::put('/{id}','update');
            Route::delete('/{id}','destroy');
        });
    });
    Route::group(['prefix' => 'user'], function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/','index');
            Route::post('/','store');
           
            Route::delete('/{id}','destroy');
        });
    });
    
});
Route::middleware(['token'])->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::controller(UserController::class)->group(function () {
            
            Route::get('/{id}','show');
            Route::put('/{id}','update');
        });
    });
    Route::group(['prefix' => 'role'], function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/','index');
            Route::get('/{id}','show');
        });
    });
    Route::group(['prefix' => 'job'], function () {
        Route::controller(JobController::class)->group(function () {
            Route::get('/','index');
            Route::get('/{id}','show');
        });
    });
    Route::group(['prefix' => 'department'], function () {
        Route::controller(DepartmentController::class)->group(function () {
            Route::get('/','index');
            Route::get('/{id}','show');
        });
    });

});

