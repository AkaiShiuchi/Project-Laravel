<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegistrationController::class, 'create'])->name('Registration.create');
Route::post('/create-user', [RegistrationController::class, 'store'])->name('Registration.create-user');

Route::get('/login', [RegistrationController::class, 'showLogin'])->name('Registration.login');
Route::post('/handleLogin', [RegistrationController::class, 'handleLogin'])->name('Registration.handle');

Route::get('/home', [RegistrationController::class, 'home'])->name('Registration.home');
Route::get('/logout', [RegistrationController::class, 'logout'])->name('Registration.logout');

Route::resource("/user", UserController::class);

Route::get('/product', [ProductController::class, 'display']);

Route::get('/file-import', [ProductController::class, 'importView'])->name('import-view');
Route::post('/import', [ProductController::class, 'import'])->name('import');
Route::get('/export-products', [ProductController::class, 'exportProducts'])->name('export-products');