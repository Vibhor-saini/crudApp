<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

Route::view('/', 'user.add-student');

Route::post('add-student', [StudentController::class,'store'])->name('add');
Route::get('list', [StudentController::class,'show'])->name('student-list');
Route::get('/students/delete/{id}', [StudentController::class,'delete'])->name('students.delete');

