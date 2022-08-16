<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function(){
    Route::post('login', [AuthController::class,'login'])->name('api.login');
    Route::post('register', [AuthController::class,'register'])->name('api.register');
    Route::apiResource('posts', PostController::class)->middleware(['middleware' => 'auth:api']);
    Route::apiResource('category', CategoryController::class)->middleware(['middleware' => 'auth:api']);
});
