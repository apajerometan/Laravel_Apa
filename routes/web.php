<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

// Show registration page
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Process registration form
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Show login page
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Process login form
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Dashboard
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Users Management
Route::get('/users', [AuthController::class, 'users'])->name('users.index');
Route::post('/users/add', [AuthController::class, 'addUser'])->name('users.add');
Route::post('/users/update', [AuthController::class, 'updateUser'])->name('users.update');
Route::post('/users/delete', [AuthController::class, 'deleteUser'])->name('users.delete');

// Customer Routes
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::post('/customers/update', [CustomerController::class, 'update'])->name('customers.update');
Route::post('/customers/delete', [CustomerController::class, 'destroy'])->name('customers.destroy');

// Profile Routes
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
