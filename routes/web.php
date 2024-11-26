<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TaskControlController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTaskController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginRegisterController::class, 'loginPage'])->name('login.main');
Route::get('/forgot_password', [LoginRegisterController::class, 'forgot_password'])->name('forgot_password.main');
Route::post('/forgot_password', [LoginRegisterController::class, 'forgotPassword'])->name('forgot_password');
Route::post('/login', [LoginRegisterController::class, 'login'])->name('login');

// Route::get('/register', [LoginRegisterController::class, 'registerPage'])->name('register.main');
// Route::post('/register', [LoginRegisterController::class, 'register'])->name('register');

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

    Route::get('control', [TaskControlController::class,'index'])->name('control.index');
    Route::get('control/{area}/{category}/{status}', [TaskControlController::class,'task'])->name('control.task');
    Route::get('control-sort/{status}', [TaskControlController::class,'sort'])->name('control.sort');

    Route::get('statistics',[StatisticsController::class,'index'])->name('statistics.index');
    Route::get('statistics-filter',[StatisticsController::class,'filter'])->name('statistics.filter');

    Route::get('category-statistics',[StatisticsController::class,'category_index'])->name('category_statistics.index');

    Route::post('answer/{answer}',[AnswerController::class,'action'])->name('answer.action');

});


Route::middleware('check:user')->group(function () {

    Route::get('profile',[UserController::class,'profileIndex'])->name('profile.index');

    Route::post('profile-update/{user}',[UserController::class,'profileUpdate'])->name('profile.update');
    
    Route::get('user_task/{status}', [UserTaskController::class,'sort'])->name('user_task.sort');

    Route::resource('user_task', UserTaskController::class);

    Route::post('user_task/{user_task}', [UserTaskController::class,'start'])->name('user_task.start');
});
