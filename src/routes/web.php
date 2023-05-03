<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'getIndex']);
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'getIndex']);
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('categories-table', [CategoryController::class, 'getTable']);
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
