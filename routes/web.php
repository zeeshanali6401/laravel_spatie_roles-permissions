<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// User Route
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/user/home', [HomeController::class, 'index'])->name('home');
});

// Admin Route
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
});

// Super Admin Route
Route::middleware(['auth', 'user-access:superAdmin'])->group(function () {
    Route::get('/superAdmin/home', [HomeController::class, 'superAdmin'])->name('superAdmin.home');
    Route::get('/role', [RoleController::class, 'index']);
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::view('/permission', 'permissions_form');
    Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
});
