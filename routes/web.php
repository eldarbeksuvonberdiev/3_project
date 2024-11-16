<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.admin_main');
});

Route::get('/login',[LoginRegisterController::class,'loginPage'])->name('login.main');
Route::post('/login',[LoginRegisterController::class,'login'])->name('login');

Route::get('/register',[LoginRegisterController::class,'registerPage'])->name('register.main');
Route::post('/register',[LoginRegisterController::class,'register'])->name('register');

// Route::get('/verify',[LoginRegisterController::class,'verification'])->name('verification');
// Route::post('/verify',[LoginRegisterController::class,'verify'])->name('verify');

Route::resource('user',UserController::class);

Route::resource('category',CategoryController::class);

Route::resource('area',AreaController::class);