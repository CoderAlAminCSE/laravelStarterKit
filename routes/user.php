<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
| In this route we will configure the user related routes
*/

Route::group(['prefix' => 'dashboard/user', 'middleware' => ['auth']], function () {
    // profile related routes
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');

    // user related routes
    Route::get('/list', [UserController::class, 'userIndex'])->name('user.index')->middleware(['can:create-user']);
    Route::post('/create', [UserController::class, 'userCreate'])->name('user.create');
    Route::post('/update', [UserController::class, 'userUpdate'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class, 'userDelete'])->name('user.delete');
});


Route::group(['prefix' => 'dashboard/role', 'middleware' => ['auth']], function () {
    // role related routes
    Route::get('/list', [UserController::class, 'roleIndex'])->name('role.index');
    Route::get('/create', [UserController::class, 'roleCreate'])->name('role.create')->middleware(['can:create-role']);
    Route::post('/store', [UserController::class, 'roleStore'])->name('role.store');
    Route::get('/edit/{id}', [UserController::class, 'roleEdit'])->name('role.edit')->middleware(['can:edit-role']);
    Route::post('/update/{role}', [UserController::class, 'roleUpdate'])->name('role.update')->middleware(['can:create-user']);
});


Route::group(['prefix' => 'dashboard/permission', 'middleware' => ['auth']], function () {
    // permission related routes
    Route::get('/list', [UserController::class, 'permissionIndex'])->name('permission.index');
});
