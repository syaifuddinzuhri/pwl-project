<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
Route::get('/submenu', [MenuController::class, 'submenu']);
Route::get('/submenu/{id}/edit', [MenuController::class, 'editSubmenu']);

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/store-submenu', [MenuController::class, 'storeSubmenu'])->name('menu.store-submenu');

Route::patch('/update-submenu/{id}', [MenuController::class, 'updateSubmenu']);

Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);
Route::resource('permission', PermissionController::class);
Route::resource('menu', MenuController::class);
Route::resource('car', CarController::class);
Route::resource('car-type', CarTypeController::class);