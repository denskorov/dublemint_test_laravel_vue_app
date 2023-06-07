<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/play/{user}', [\App\Http\Controllers\LuckyController::class, 'play'])->name('play');
Route::get('/history/{user}', [\App\Http\Controllers\LuckyController::class, 'history'])->name('history');
Route::get('/deactivate-link/{user}', [\App\Http\Controllers\LuckyController::class, 'deactivateLink'])->name('deactivateLink');
