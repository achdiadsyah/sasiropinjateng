<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
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
        Route::post('delete', [App\Http\Controllers\AdminController::class, 'doDelete'])->name('delete');
        Route::post('verify', [App\Http\Controllers\AdminController::class, 'doVerify'])->name('verify');

        Route::get('verified-user', [App\Http\Controllers\AdminController::class, 'verifiedUser'])->name('verified-user');

        Route::get('download-data', [App\Http\Controllers\AdminController::class, 'downloadAll'])->name('download-data');

        Route::get('app-config', [App\Http\Controllers\AdminController::class, 'appConfig'])->name('app-config');
        Route::post('app-config-update', [App\Http\Controllers\AdminController::class, 'appConfigUpdate'])->name('app-config-update');
    });
});

Route::get('/link', function () {        
    $target = '/home/sasn2683/public_html/storage/app/public';
    $shortcut = '/home/sasn2683/public_html/public/storage';
    symlink($target, $shortcut);
 });