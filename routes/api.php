<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

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


Route::delete('/deleteGerant/{id}', [App\Http\Controllers\adminController::class, 'deleteGerant']);

Route::post('/newForm', [App\Http\Controllers\indexController::class, 'newForm']);

Route::delete('/delete/{id}',[App\Http\Controllers\indexController::class, 'deleteData'])->name('deleteData');

