<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\Frontend\UserController::class, 'dashboard']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\Frontend\UserController::class, 'login'])->name('login');
Route::get('/user-profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
Route::get('/user-wishlist', [App\Http\Controllers\Frontend\UserController::class, 'wishlist']);
Route::get('/user-cart', [App\Http\Controllers\Frontend\UserController::class, 'cart']);
Route::get('/products', [App\Http\Controllers\Frontend\ProductsController::class, 'index']);


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\Admin\AdminController::class, 'dashboard']);
    Route::get('/brands',[App\Http\Controllers\Admin\AdminController::class, 'brands']);
    Route::get('/add-brand',[App\Http\Controllers\Admin\AdminController::class, 'add_brand']);
    Route::get('/categories-list',[App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::post('/save-category',[App\Http\Controllers\Admin\CategoryController::class, 'save_category']);
    Route::post('/save-brand',[App\Http\Controllers\Admin\AdminController::class, 'save_brand']);
    Route::get('/edit-brand/{id}',[App\Http\Controllers\Admin\AdminController::class, 'edit_brand']);
    Route::post('/update-brand',[App\Http\Controllers\Admin\AdminController::class, 'update_brand']);
    Route::get('/delete-brand/{id}',[App\Http\Controllers\Admin\AdminController::class, 'delete_brand']);
});