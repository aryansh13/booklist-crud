<?php

use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route Books
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::get('/books/filter-by-category', [BookController::class, 'filterByCategory'])->name('books.filterByCategory');
Route::get('/books/filter-by-publication-date', [BookController::class, 'filterByPublicationDate'])->name('books.filterByPublicationDate');

//Route Books Category
Route::get('/categories', [BookCategoryController::class, 'index'])->name('categories.index');
Route::post('/categories/store', [BookCategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [BookCategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [BookCategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [BookCategoryController::class, 'destroy'])->name('categories.destroy');
