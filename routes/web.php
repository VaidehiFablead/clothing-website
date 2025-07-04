<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
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
})->name('tables');


// change password
Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.form');
Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password.change');


// Show the form (GET)
Route::get('/addproductform', [ProductController::class, 'create'])->name('product.create');

// Handle the form submission (POST)
Route::post('/addproductform', [ProductController::class, 'store'])->name('product.store');
Route::get('/addproductform', [ProductController::class, 'create'])->name('addProductForm');



// addcategory

Route::get('/addcategoryForm', [CategoryController::class, 'create'])->name('addcategoryForm');
Route::post('/addcategoryForm', [CategoryController::class, 'store'])->name('addcategory.store');


// viewcategory

Route::get('/viewcategory', [CategoryController::class, 'index'])->name('viewcategory');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store'); 
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');


// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// view product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product', [ProductController::class, 'index'])->name('product');

// Route::get('/product', [ProductController::class, 'index'])->name('product');
