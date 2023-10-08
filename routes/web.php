<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::view('/', 'auth.login')->name('login');
Route::view('/register', 'auth.register');
ROute::post('/', [AuthController::class, 'login']);
ROute::post('/register', [UserController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::group(["prefix" => "admin", "middleware" => ["auth", "adminCheck"], "as" => "admin."], function () {
    Route::get('/', [DashboardController::class, 'admin']);
    Route::resource('/buses', BusController::class)->only('index');
    Route::resource('/users', UserController::class)->only('index');
    Route::put('/users', [UserController::class, 'updateSingleUser']);
    Route::view('/settings', 'admin.settings');
    Route::put('/settings', [UserController::class, 'update']);
});

Route::group(["prefix" => "passenger", "middleware" => ["auth", "passengerCheck"], "as" => "passenger."], function () {
    Route::get('/', [DashboardController::class, 'passenger']);
    Route::view('/settings', 'passenger.settings');
    Route::put('/settings', [UserController::class, 'update']);
});
