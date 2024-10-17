<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::resource('books', BookController::class);
Route::get('/', [Controller::class, 'landing'])->name('home');
Route::resource('loans', LoanController::class);


Route::prefix('/books')->name('books.')->group(function(){
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/add', [BookController::class, 'store'])->name('store');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit'); // route edit
    Route::patch('/{book}', [BookController::class, 'update'])->name('update'); // route update
    Route::resource('books', BookController::class)->except(['show']);
});

Route::prefix('/members')->name('members.')->group(function(){
    Route::get('/add', [MemberController::class, 'create'])->name('create');
    Route::post('/add', [MemberController::class, 'store'])->name('store');
    Route::get('/', [MemberController::class, 'index'])->name('index');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('destroy');
    Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('edit'); 
    Route::patch('/{member}', [MemberController::class, 'update'])->name('update');
});

Route::prefix('/loans')->name('loans.')->group(function() {
    Route::get('/create', [LoanController::class, 'create'])->name('create');
    Route::post('/', [LoanController::class, 'store'])->name('store');
    Route::get('/', [LoanController::class, 'index'])->name('index');
    Route::delete('/{loan}', [LoanController::class, 'destroy'])->name('destroy');
    Route::get('/{loan}/edit', [LoanController::class, 'edit'])->name('edit');
    Route::put('/{loan}', [LoanController::class, 'update'])->name('update');
    Route::get('/{loan}', [LoanController::class, 'show'])->name('show'); // ini untuk menampilkan detail pinjaman
});
