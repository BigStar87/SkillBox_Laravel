<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('mainpage');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/users_list', function () {
    $users = [
        'Ivan',
        'Petr',
        'Nikolay',
        'Vasiliy',
        'Oleg'
    ];
    return view('users', ['users' => $users]);
});

Route::get('/uppercase', function () {
    return view('testdir');
});

//Route::get('/books', [\App\Http\Controllers\EntityController::class, 'index'])->name('books');
//Route::post('/books', [\App\Http\Controllers\EntityController::class, 'store'])->name('save_book');
//Route::get('/remove_book{id}', [\App\Http\Controllers\EntityController::class, 'delete'])->name('remove_book');

//Route::get('/upload', [\App\Http\Controllers\FileUploadController::class, 'index']);
//Route::post('/upload', [\App\Http\Controllers\FileUploadController::class, 'upload'])->name('upload_file');

//Route::get('/redirect_test', \App\Http\Controllers\TestRedirectController::class);

//Route::get('/userform', [\App\Http\Controllers\FormProcessor::class, 'index']);
//Route::post('/userform', [\App\Http\Controllers\FormProcessor::class, 'store'])->name('store-user');
//Route::post('/userform', [\App\Http\Controllers\FormProcessor::class, 'showStore'])->name('store-user');

//Route::get('/test_database', [\App\Http\Controllers\NewEmployeeController::class, 'index']);
//Route::post('/test_database', [\App\Http\Controllers\NewEmployeeController::class, 'store'])->name('save_employees');
