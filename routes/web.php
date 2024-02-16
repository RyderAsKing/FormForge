<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\FormController;

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

Route::get('/', [App\Http\Controllers\ResponseController::class, 'index']);

Route::middleware(['admin', 'auth'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name(
        'dashboard'
    );

    // forms
    Route::name('admin')->resource('admin/forms', FormController::class);

    // responses
    Route::name('admin')->resource(
        'admin/responses',
        App\Http\Controllers\Admin\ResponseController::class
    );

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});

require __DIR__ . '/auth.php';
