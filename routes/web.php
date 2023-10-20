<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OffertController;
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
// Add Offerts / Manage
Route::get('/offerts/create', [OffertController::class, 'create'])->middleware('auth');
Route::post('/offerts', [OffertController::class, 'store'])->middleware('auth');

Route::get('/offerts/{offert}/edit', [OffertController::class, 'edit'])->middleware('auth');
Route::put('/offerts/{offert}', [OffertController::class, 'update'])->middleware('auth');

Route::get('/offerts/manage', [OffertController::class, 'manage'])->middleware('auth');

Route::delete('/offerts/{offert}', [OffertController::class, 'delete'])->middleware('auth');
Route::get('/offerts/{offert}', [OffertController::class, 'show']);


// Sign up / Sign in / Sign Out
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

