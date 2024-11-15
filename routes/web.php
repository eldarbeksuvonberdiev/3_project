<?php

use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/login',[LoginRegisterController::class,'loginPage'])->name('login.main');
Route::post('/login',[LoginRegisterController::class,'login'])->name('login');

Route::get('/register',[LoginRegisterController::class,'registerPage'])->name('register.main');
Route::post('/register',[LoginRegisterController::class,'register'])->name('register');

Route::get('/verify',[LoginRegisterController::class,'verification'])->name('verification');
Route::post('/verify',[LoginRegisterController::class,'verify'])->name('verify');

Route::get('/',[UserController::class,'index'])->name('index');