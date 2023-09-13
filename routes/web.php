<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/category',[CategoryController::class,'index'])->name('category');
Route::get('/category/add', [CategoryController::class, 'create'])->name('category.add.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category{category}/update', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category{category}/delete', [CategoryController::class, 'destroy'])->name('category.delete');

require __DIR__.'/auth.php';
