<?php

use App\Http\Controllers\Management\AuthController;
use App\Http\Controllers\Management\CarsController;
use App\Http\Controllers\Management\ManagementController;
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

Route::prefix('management')->group(function() {
    Route::get("login", [AuthController::class, 'login'])->name("login");
    Route::post("login", [AuthController::class, 'loginPost']);
    // Route::middleware(['auth', 'role:super-admin'])->group(function () {
        Route::get("/", [ManagementController::class, 'dashboard']);
        Route::resource("cars", CarsController::class);
    // });
});
