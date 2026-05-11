<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;


//Routes Public
Route::get('/', function () {
    return view('user.search');
});

Route::get('/search', [BookController::class,'search']);
Route::get('/detail/{id}', [BookController::class,'detail']);

//Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


//Auth Routes Admin
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin', [AdminController::class, 'index']) ->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    
    Route::get('/admin/books', [AdminController::class, 'books'])->name('admin.books');
    Route::get('/admin/create', [BookController::class, 'create']);
    Route::get('/admin/{id}/edit', [BookController::class, 'edit']);    
    Route::get('/admin/members', [AdminController::class, 'members']);
    Route::post('/admin/store', [AdminController::class, 'store']);
    Route::put('/admin/{book}', [AdminController::class, 'update']);
    Route::delete('/admin/{book}', [AdminController::class, 'destroy']);
});


// Route::get('/pencarian', function () {
//     return view('search');
// });