<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
| In this route we will configure the user related routes
*/

Route::group(['prefix' => 'dashboard/user', 'middleware' => ['auth']], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
});
