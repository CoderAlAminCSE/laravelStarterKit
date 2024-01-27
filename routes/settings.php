<?php

use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;

/*
| settings related routes
*/

Route::group(['prefix' => 'dashboard/setting', 'middleware' => ['auth']], function () {
    Route::get('/general', [SettingController::class, 'index'])->name('setting.general.index');
    Route::post('/general/store', [SettingController::class, 'store'])->name('setting.general.store');
    Route::get('/smtp', [SettingController::class, 'showSmtpSettingsForm'])->name('setting.smtp.index');
    Route::post('/smtp/update', [SettingController::class, 'updateSmtp'])->name('smtp.update');
    Route::post('/smtp/connection/test', [SettingController::class, 'smtpConnectionTest'])->name('smtp.connection.test');
});
