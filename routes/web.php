<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('hello', function () {
    return view('hello');
});

Route::prefix('tasks')
->name('tasks.')
// ->middleware('auth')
->controller(TaskController::class)
->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::get('/create', 'create')->name('create');
 
});