<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showregister'])->name('showregister');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'show'])->name('adduser.show');
    Route::post('/adduser', [UserController::class, 'add'])->name('adduser.add');
    Route::put('/adduser/{id}', [UserController::class, 'update'])->name('adduser.update');
    Route::delete('/adduser/{id}', [UserController::class, 'delete'])->name('adduser.delete');
});
