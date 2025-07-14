<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

Route::view('/','user.add-student');
Route::get('/', [StudentController::class, 'create'])->name('students.create');
Route::get('/list', [StudentController::class,'show'])->name('students-list');
Route::post('/add-student', [StudentController::class,'store'])->name('students-add');
Route::get('/students/delete/{id}', [StudentController::class,'delete'])->name('students.delete');
Route::get('/students/edit/{id}', [StudentController::class,'edit'])->name('students.edit');
Route::post('/students/update/{id}', [StudentController::class,'update'])->name('students.update');
Route::post('/delete-multi', [StudentController::class, 'deleteMultiple'])->name('students.deleteMulti');
Route::get('/search', [StudentController::class,'search'])->name('students-search');


