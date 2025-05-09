<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// routes/web.php
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');

