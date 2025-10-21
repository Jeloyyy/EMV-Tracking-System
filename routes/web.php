<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\User;

// Redirect login
Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Middlewares
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'resortStaffs'])->name('dashboard');
    Route::get('/userDashboard', [DashboardController::class, 'resortStaffs'])->name('userDashboard');
    
    Route::view('/about', 'about')->name('about');
    Route::view('/contact', 'contact')->name('contact');
    Route::view('/settings', 'settings')->name('settings');

    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/users/adduser', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/adduser', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'resortStaffs'])->name('users.resortStaffs');
    Route::get('/users/table', [UserController::class, 'resortStaffsTable'])->name('users.resortStaffsTable');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/add-supplies', [UserController::class, 'addSupplies'])->name('users.addSupplies');
    Route::get('/supplies', [UserController::class, 'supplies'])->name('users.supplies');
    Route::post('/supplies', [UserController::class, 'storeSupply'])->name('supplies.store');
    Route::get('/supplies/{id}/edit', [UserController::class, 'editSupply'])->name('supplies.edit');
    Route::put('/supplies/{id}/update', [UserController::class, 'updateQuantity'])->name('supplies.updateQuantity');
    Route::delete('/supplies/{id}', [UserController::class, 'destroySupply'])->name('supplies.destroy');

    Route::get('/issued-supplies', [UserController::class, 'issuedSupplies'])->name('users.issuedSupplies');
    Route::get('/issuance', [UserController::class, 'issuance'])->name('users.issuance');
    Route::post('/issuance', [UserController::class, 'storeIssuance'])->name('issuance.store');
});