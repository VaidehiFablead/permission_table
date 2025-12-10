<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReportController;
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

Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'index'])->name('register');
Route::post('/login', [UserController::class, 'authenticate'])->name('auth.login');

// Protected routes (only for logged-in users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    // dashboard staff count
    Route::get('/staff-count', [UserController::class, 'staffCount']);


    // Staff module example
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');

    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // report
    Route::get('/report', [ReportController::class, 'index'])->name('report.view');


    // ai chatbot
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

});
