<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {return view('home');})->name('home');
Route::get('app', function () {return view('app');})->name('app');


Route::get('welcome', [HomeController::class, 'welcome']);

Route::prefix('tasks')
->name('tasks.')
// ->middleware('auth')
->controller(TaskController::class)
->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('{id}/edit', 'edit')->name('edit');
    Route::get('create', 'create')->name('create');

    Route::post('store', 'store')->name('store');
    Route::put('{id}/update', 'update')->name('update');
    Route::get('{id}/delete', 'delete')->name('delete');
    Route::delete('{id}/destroy', 'destroy')->name('destroy');

});