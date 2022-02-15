<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as UC;
use GuzzleHttp\Middleware;

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

Route::get('/home', [App\Http\Controllers\CodeController::class, 'index'])->name('home');

Auth::routes();


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
        ->middleware('admin')->name('code.update');
    Route::delete('/destroy/{code}', [App\Http\Controllers\CodeController::class, 'destroy'])
        ->middleware('admin')->name('code.destroy');
});

Route::group([
    'prefix' => '/user'
], function() {
    Route::get('/profile/name', [UC::class, 'updateNamePage'])
        ->name('user.updateName');
    Route::get('/profile/enableAdmin', [UC::class, 'enableAdmin'])
        ->middleware('admin')->name('user.enableAdmin');
    Route::get('/profile/enableAdmin/action/', [UC::class, 'enableAdminAction'])
        ->middleware('admin')->name('user.enableAdminAction');
    Route::get('/profile/disableAdmin/action/', [UC::class, 'disableAdminAction'])
        ->middleware('admin')->name('user.disableAdminAction');
    Route::post('/profile/name', [UC::class, 'updateNameAction'])->name('user.updateName.action');
    Route::get('/profile/password/update', [App\Http\Controllers\Auth\UpdatePasswordController::class, 'pageUpdate'])
        ->name('user.updatePassword');
    Route::post('/profile/password/update', [App\Http\Controllers\Auth\UpdatePasswordController::class, 'update'])
        ->name('user.updatePassword.action');
    Route::get('/profile/email/update', [UC::class, 'updateEmailPage'])
        ->name('user.updateEmail');
    Route::post('/profile/email/update', [UC::class, 'updateEmailAction'])
        ->name('user.updateEmailAction');
});
