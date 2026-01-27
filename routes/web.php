<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;

Route::get('/', [HomeController::class, 'my_home']);

// Public / auth routes
Route::get('/home', [HomeController::class, 'index']);

// Cart & ordering (user)
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/my_cart', [HomeController::class, 'my_cart'])->middleware('auth');
Route::delete('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->middleware('auth');
Route::post('/confirm_order', [HomeController::class, 'confirm_order'])->middleware('auth');

// Booking (user)
Route::post('/book_table', [HomeController::class, 'book_table'])->middleware('auth');

// Google login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add_food', [AdminController::class, 'add_food']);
    Route::post('/upload_food', [AdminController::class, 'upload_food']);
    Route::get('/view_food', [AdminController::class, 'view_food']);
    Route::get('/update_food/{id}', [AdminController::class, 'update_food']);
    Route::post('/edit_food/{id}', [AdminController::class, 'edit_food']);
    Route::delete('/delete_food/{id}', [AdminController::class, 'delete_food']);

    Route::get('/orders', [AdminController::class, 'orders']);
    Route::post('/orders/{id}/on_the_way', [AdminController::class, 'on_the_way']);
    Route::post('/orders/{id}/delivered', [AdminController::class, 'delivered']);
    Route::post('/orders/{id}/canceled', [AdminController::class, 'canceled']);

    Route::get('/reservation', [AdminController::class, 'reservation']);
    Route::post('/booking/{id}/accept', [AdminController::class, 'accept_booking']);
    Route::post('/booking/{id}/reject', [AdminController::class, 'reject_booking']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
