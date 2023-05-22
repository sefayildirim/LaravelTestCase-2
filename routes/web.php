<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('seller')->middleware(['auth', 'verified','seller'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.seller-panel.index');
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'index')->name('category.index');
        Route::post('/category','store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::put('/category/update/{id}', 'update')->name('category.update');
        Route::delete('/category/{id}','destroy')->name('category.destroy');
    });
    Route::controller(ProductController::class)->group(function(){
        Route::get('/product', 'index')->name('product.index');
        Route::post('/product','store')->name('product.store');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::put('/product/update/{id}', 'update')->name('product.update');
        Route::delete('/product/{id}','destroy')->name('product.destroy');
    });
});

/*Route::prefix('product')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.customer-panel.index');
    });

});*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
