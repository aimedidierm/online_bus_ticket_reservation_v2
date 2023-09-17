<?php

use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'auth.login')->name('login');
Route::view('/register', 'auth.register');
ROute::post('/', [AuthController::class, 'login']);
ROute::post('/register', [UserController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::group(["prefix" => "admin", "middleware" => ["auth", "adminCheck"], "as" => "admin."], function () {
    Route::get('/', [DashboardController::class, 'admin']);
});

Route::group(["prefix" => "passenger", "middleware" => ["auth", "passengerCheck"], "as" => "passenger."], function () {
    Route::get('/', [DashboardController::class, 'passenger']);
});
