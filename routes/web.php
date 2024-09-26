<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DataController;

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

Route::get('/', [App\Http\Controllers\indexController::class, 'index'])->name('index');

Route::get('/admin', [DataController::class, 'admin'])->name('data.table');
Route::post('/download-selected', [DataController::class, 'downloadSelected'])->name('download.selected');

Route::get('/downloadALL', [DataController::class, 'downloadALL'])->name('downloadALL');
Route::get('/details/{uid}', [DataController::class, 'details'])->name('details');

Route::get('/logout', [DataController::class, 'logout'])->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('/home', [DataController::class, 'admin'])->name('home');
