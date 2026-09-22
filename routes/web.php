<?php

use App\Http\Controllers\Librarian\BookController;
use App\Http\Controllers\Member\BookController as MemberBookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->prefix('librarian')->name('librarian.')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');

    Route::post('/books/{book}/copies', [BookController::class, 'storeCopy'])->name('books.copies.store');
});

Route::middleware(['auth'])->prefix('member')->name('member.')->group(function () {
    Route::get('/books', [MemberBookController::class, 'index'])->name('books.index');
    Route::post('/books/{book}/borrow', [MemberBookController::class, 'borrow'])->name('books.borrow');
});

require __DIR__.'/auth.php';
