<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
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


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/users', [RegisterController::class, 'get'])->name('users.index');
// Route::post('/users/{$id}', [RegisterController::class, 'update'])->name('users');

Route::get('/user/{id}/edit', [RegisterController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [RegisterController::class, 'update'])->name('user.update');
