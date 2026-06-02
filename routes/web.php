<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\ProfileController;

/* ==================== PUBLIC ROUTES ==================== */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');

Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

/* ==================== PROTECTED ROUTES ==================== */
Route::middleware('auth')->group(function () {

    /* Dashboard */
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');

    /* Users Management */
    Route::get('/users',           [UserController::class, 'index'])->name('users.index');
    Route::post('/users',          [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}',    [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    /* Grocery List */
    Route::get('/grocery',              [GroceryController::class, 'index'])->name('grocery.index');
    Route::post('/grocery',             [GroceryController::class, 'store'])->name('grocery.store');
    Route::put('/grocery/{grocery}',    [GroceryController::class, 'update'])->name('grocery.update');
    Route::delete('/grocery/{grocery}', [GroceryController::class, 'destroy'])->name('grocery.destroy');

    /* Profile */
    Route::get('/profile',         [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update',  [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

});