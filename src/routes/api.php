<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

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
Route::get('category/{category_id}/books', [BookController::class, 'getBooksByCategory']);
Route::get('book/{id}', [BookController::class, 'getBookById']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
