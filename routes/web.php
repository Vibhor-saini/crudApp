<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
use App\Http\Controllers\AuthController;



Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [StudentController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/list', [StudentController::class, 'show'])->name('students-list');
    Route::post('/student/register', [StudentController::class, 'store'])->name('students-add');
    Route::get('/students/delete/{id}', [StudentController::class, 'delete'])->name('students.delete');
    Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
    Route::post('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::post('/delete-multi', [StudentController::class, 'deleteMultiple'])->name('students.deleteMulti');
    Route::get('/search', [StudentController::class, 'search'])->name('students-search');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
});


Route::get('/student/register', [StudentController::class, 'create'])->name('students.create');
Route::post('/student/register', [StudentController::class, 'store'])->name('students-add');

// Only logged-in students
Route::middleware(['user'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'studentInfo'])->name('student.dashboard');
    Route::post('/student/update-profile', [StudentController::class, 'updateProfile'])->name('student.updateProfile');
    Route::post('/student/change-password', [StudentController::class, 'changePassword'])->name('student.changePassword');
});

//wnoa qymr wdsa remh
//email
