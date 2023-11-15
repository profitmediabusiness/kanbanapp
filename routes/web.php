<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('users', [HomeController::class, 'create']);
    // ->name('hello');

Route::prefix('roles')
->name('roles.')
->middleware('auth')
->controller(HomeController::class)
->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('{id}/edit', 'edit')->name('edit');
    Route::put('{id}/update', 'update')->name('update');
    Route::get('{id}/delete', 'delete')->name('delete');
    Route::delete('{id}/destroy', 'destroy')->name('destroy');
});