<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AreaTaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTaskController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginRegisterController::class, 'loginPage'])->name('login.main');
Route::post('/login', [LoginRegisterController::class, 'login'])->name('login');

Route::get('/register', [LoginRegisterController::class, 'registerPage'])->name('register.main');
Route::post('/register', [LoginRegisterController::class, 'register'])->name('register');

Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
// Route::get('/verify',[LoginRegisterController::class,'verification'])->name('verification');
// Route::post('/verify',[LoginRegisterController::class,'verify'])->name('verify');

Route::get('/', function () {
    return view('layouts.admin_main');
})->name('index')->middleware('check:admin,user');

Route::resource('answer', AnswerController::class)->middleware('check:admin,user');


Route::middleware('check:admin')->group(function () {

    Route::resource('user', UserController::class);

    Route::resource('category', CategoryController::class);

    Route::resource('area', AreaController::class);

    Route::get('task-sort/{status}', [TaskController::class,'sort'])->name('task.sort');

    Route::resource('task', TaskController::class);

    Route::resource('area_task', AreaTaskController::class);

});


Route::middleware('check:user')->group(function () {

    Route::get('profile',[UserController::class,'profileIndex'])->name('profile.index');

    Route::post('profile-update/{user}',[UserController::class,'profileUpdate'])->name('profile.update');
    
    Route::get('user_task_sort/{status}', [UserTaskController::class,'sort'])->name('user_task.sort');

    Route::resource('user_task', UserTaskController::class);
});
