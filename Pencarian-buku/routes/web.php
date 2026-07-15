<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\RackController;
use App\Http\Controllers\User\BookController as UserBookController;


//Routes Public
// Redirect root ke halaman pencarian buku
Route::redirect('/', '/pencarian-buku');

// Halaman pencarian buku
Route::get('/pencarian-buku', function () {
    return view('user.search');
})->name('user.search');

Route::get('/search', [UserBookController::class, 'search']);
Route::get('/pencarian-buku/detail/{id}', [UserBookController::class, 'detail']);

//Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


//Auth Routes Admin
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/admin/books', [AdminController::class, 'books'])->name('admin.books');
    Route::get('/admin/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
    Route::post('/admin/books', [AdminBookController::class, 'store'])->name('admin.books.store');
    Route::get('/admin/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/admin/books/{book}', [AdminBookController::class, 'update'])->name('admin.books.update');
    Route::delete('/admin/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/admin/books/{book}', [AdminController::class, 'show']);

    Route::get('/admin/racks', [AdminController::class, 'racks']);
    Route::get('/admin/racks/create', [RackController::class, 'create'])->name('admin.racks.create');
    Route::post('/admin/racks', [RackController::class, 'store'])->name('admin.racks.store');
    Route::get('/admin/racks/{rack}/edit', [RackController::class, 'edit'])->name('admin.racks.edit');
    Route::put('/admin/racks/{rack}', [RackController::class, 'update'])->name('admin.racks.update');
    Route::delete('/admin/racks/{rack}', [RackController::class, 'destroy'])->name('admin.racks.destroy');
});