<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\CodeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => '/code',
], function(){
    Route::get('/search', [App\Http\Controllers\CodeController::class, 'search']);
    Route::get('/', [App\Http\Controllers\CodeController::class, 'index'])
        ->name('code.index');
    Route::get('/create', [App\Http\Controllers\CodeController::class, 'create'])
        ->middleware('auth')->name('code.create');
    Route::get('/edit/{code}', [App\Http\Controllers\CodeController::class, 'edit'])
        ->middleware('auth')->name('code.edit');
    Route::post('/create', [App\Http\Controllers\CodeController::class, 'store'])
        ->middleware('auth')->name('code.store');
    Route::post('/edit/{code}', [App\Http\Controllers\CodeController::class, 'update'])
        ->middleware('auth')->name('code.update');
    Route::delete('/destroy/{code}', [App\Http\Controllers\CodeController::class, 'destroy'])
        ->middleware('auth')->name('code.destroy');
});
