<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/form1', [App\Http\Controllers\indexController::class, 'form1']);

Route::post('/form2', [App\Http\Controllers\indexController::class, 'form2']);

Route::post('/form3', [App\Http\Controllers\indexController::class, 'form3']);
