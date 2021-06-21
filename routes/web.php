<?php

use App\Models\User;
use App\Models\Menu;

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\CarController as UserCarController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
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

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['role:usr']], function () {
        Route::get('/', function () {
            return redirect()->route('dashboard.index');
        });
        Route::get('transaction/cetak-nota/{id}', [UserTransactionController::class, 'cetakNota'])->name('cetaknota');
        Route::get('transaction/upload-bukti-pembayaran/{id}', [UserTransactionController::class, 'showUploadBukti']);
        Route::put('transaction/upload-bukti-pembayaran/{id}', [UserTransactionController::class, 'uploadBukti'])->name('uploadbukti');
        Route::get('transaction/car/{id}', [UserTransactionController::class, 'transaction'])->name('transaction.new');
        Route::resource('car', UserCarController::class);
        Route::resource('transaction', UserTransactionController::class);
    });

    Route::middleware(['role:adm'])->group(function () {
        Route::get('car/get-status/{id}', [CarController::class, 'getStatus']);
        Route::put('car/update-status/{id}', [CarController::class, 'updateStatus'])->name('car.updatestatus');
        Route::put('transaction/update-pengembalian/{id}', [TransactionController::class, 'updatePengembalian'])->name('updatePengembalian');
        Route::resource('user', UserController::class);
        Route::resource('car', CarController::class);
        Route::resource('car-type', CarTypeController::class);
        Route::resource('transaction', TransactionController::class);
    });
});