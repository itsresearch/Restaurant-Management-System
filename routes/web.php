<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


route::get('/',[HomeController::class,'my_home']);
route::get('/add_food',[AdminController::class,'add_food']);
route::post('/upload_food',[AdminController::class,'upload_food']);
route::get('/view_food',[AdminController::class,'view_food']);
route::get('/delete_food/{id}',[AdminController::class,'delete_food']);


route::get('/home',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
