<?php

use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
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
Route::get('/', [UserController::class, 'login']);
Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');
Route::get('/register', [UserController::class, 'index'])->name('register');

// staff
Route::get('/staff/create',[StaffController::class,'create'])->name('staff.create');

