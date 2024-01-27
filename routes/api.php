<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginSignUpController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceControllers\TimePeriodController;
use App\Http\Controllers\ServiceControllers\TagController;
use App\Http\Controllers\ServiceControllers\OkrCategoryController;
use App\Http\Controllers\Objectives\ObjectController;
use App\Http\Controllers\UserFollowedOkrsController;
use App\Http\Controllers\KeysController;
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
Route::middleware(['token', 'check.admin'])->group(function () {
    Route::resource('department', DepartmentController::class);
    Route::resource('role', RoleController::class);
    Route::resource('job', JobController::class);
    Route::resource('user', UserController::class);
    Route::resource('tag', TagController::class);
    Route::resource('okr-category', OkrCategoryController::class);
});

Route::middleware(['token'])->group(function () {
    Route::resource('user', UserController::class)->only(['show', 'update']);
    Route::resource('role', RoleController::class)->only(['index', 'show']);
    Route::resource('job', JobController::class)->only(['index', 'show']);
    Route::resource('department', DepartmentController::class)->only(['index', 'show']);
    Route::resource('time-period', TimePeriodController::class)->only(['index']);
    Route::resource('tag', TagController::class)->only(['index']);
    Route::resource('okr-category', OkrCategoryController::class)->only(['index']);
    Route::resource('objects', ObjectController::class);
    Route::get('/okr/my-okrs', [ObjectController::class, 'showMyObjects']);
    Route::get('/okr/my-departments', [ObjectController::class, 'showDepartmentObjects']);
    Route::get('/okr/followed-okr', [UserFollowedOkrsController::class, 'getUserFollowedOkrs']);
    Route::post('/okr/followed-okr', [UserFollowedOkrsController::class, 'store']);
    Route::delete('/okr/followed-okr/{userFollowedOkrs}', [UserFollowedOkrsController::class, 'destroy']);
    Route::post('/keys', [KeysController::class, 'store']);
});

// key and sub key types 
// check in frequency
// cascade approach
// Milestone Sequence
// Milestone labels