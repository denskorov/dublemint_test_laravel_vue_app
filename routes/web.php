<?php

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
    return redirect('/home');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'signed']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



});

Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
});
