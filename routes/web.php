<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
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

// Route::get('/', function () {
//     return view('index');
// });

// Login
Route::get('/', function () {
    return view('login');
});
// Show login form (GET)
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');

// Handle login form submission (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login');





// profile
Route::get('/profile', function () {
    return view('profile');
});
Route::post('/profile', [ProfileController::class, 'showprofile'])->name('profile');

// update Profile
Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

// tables
Route::get('/tables', function () {
    return view('tables');
});

// change password
Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.form');
Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password.change');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
