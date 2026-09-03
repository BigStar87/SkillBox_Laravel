<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TestValidationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/employee', [EmployeeController::class, 'index']);
//Route::post('/employee', [EmployeeController::class, 'store'])->name('store-form');
//Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('edit-form');
//Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('update-form');

//Route::get('/test_validation', [TestValidationController::class, 'show'])->name('test_validation_form');
//Route::post('/test_validation', [TestValidationController::class, 'post'])->name('post_validation_form');

Route::get('/form_book', [BookController::class, 'showFormBook']);
Route::post('/form_book', [BookController::class, 'store'])->name('store-form');
