<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('roles', RolesController::class);
    Route::get('get_data_role', [RolesController::class, 'get_data'])->name('roles.get_data');
    Route::get('/create_role', [RolesController::class, 'create'])->name('role.create');
    Route::post('/store_role', [RolesController::class, 'store'])->name('role.store');
    Route::get('/view_permission_role/{id}', [RolesController::class, 'view_permission_role'])->name('role.view_permission_role');
    Route::delete('/role/{id}', [RolesController::class, 'destroy'])->name('role.destroy');

    Route::resource('permission', PermissionController::class);
    Route::get('get_data_permission', [PermissionController::class, 'get_data'])->name('permission.get_data');
    Route::get('/create_permission', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/store_permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::delete('/permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    Route::get('user_list/', [UserListController::class, 'index'])->name('user_list.index');
    Route::get('get_data_user', [UserListController::class, 'get_data'])->name('user_list.get_data');
});

require __DIR__ . '/auth.php';
