<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee', [\App\Http\Controllers\EmployeeController::class, 'index']);
Route::post('/employee', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('store-form');
Route::get('/employee/{id}/edit', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name('edit-form');
Route::put('/employee/{id}', [\App\Http\Controllers\EmployeeController::class, 'update'])->name('update-form');
