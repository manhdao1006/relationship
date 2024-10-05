<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMember;
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
    return view('welcome');
});

Route::resource('products', ProductController::class);

Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'handleLogin']);

Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'handleRegister']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('member', [MemberController::class, 'dashboard'])
    ->name('member.dashboard')
    ->middleware(['auth', 'is_member']);

Route::get('admin', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['auth', 'is_admin']);
