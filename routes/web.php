<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('close');
});

Route::get('getprovince', [App\Http\Controllers\HomeController::class, 'province']);
Route::get('getregency', [App\Http\Controllers\HomeController::class, 'regency']);
Route::post('register-peserta', [App\Http\Controllers\HomeController::class, 'saveData'])->name('register-peserta');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
    
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [App\Http\Controllers\AdminController::class, 'loginPage'])->name('login-page');
        Route::post('doLogin', [App\Http\Controllers\AdminController::class, 'doLogin'])->name('doLogin');
    });
    
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('new-user', [App\Http\Controllers\AdminController::class, 'newUser'])->name('new-user');
        Route::post('delete-user', [App\Http\Controllers\AdminController::class, 'doDeleteUser'])->name('delete-user');
        Route::post('delete-verify', [App\Http\Controllers\AdminController::class, 'doDeleteVerify'])->name('delete-verify');
        Route::post('verify', [App\Http\Controllers\AdminController::class, 'doVerify'])->name('verify');
        Route::post('updateUser', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('update-user');

        Route::get('verified-user', [App\Http\Controllers\AdminController::class, 'verifiedUser'])->name('verified-user');

        Route::get('download-data', [App\Http\Controllers\AdminController::class, 'downloadAll'])->name('download-data');

        Route::get('app-config', [App\Http\Controllers\AdminController::class, 'appConfig'])->name('app-config');
        Route::post('app-config-update', [App\Http\Controllers\AdminController::class, 'appConfigUpdate'])->name('app-config-update');
    });
});