<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;

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

Route::group(['prefix'=>'auth'], function(){
    Route::post('register', [AuthController::class, 'postRegister']);
    Route::post('login', [AuthController::class, 'postLogin']);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'postLogout']);
});

Route::get('categories', [CategoryController::class, 'getCategories']);
//Route::get('category/{category_id}/books', [CategoryController::class, 'getCategoryById']);
Route::get('category/{slug}/books', [CategoryController::class, 'getCategoryBySlug']);
//Route::get('book/{id}', [BookController::class, 'getBookById']);
Route::get('book/{slug}', [BookController::class, 'getBookBySlug']);

Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('user', [UserController::class, 'getIndex']);
    Route::post('email/verify', [AuthController::class, 'postVerifyEmail']);
    Route::post('checkout', [CheckoutController::class, 'postIndex']);
});


/* controller for testing */
Route::group(['prefix'=>'test'], function(){
    Route::any('send-email', [TestController::class, 'sendVerification']);
});
