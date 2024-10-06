<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
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
    Route::delete('/role/{id}', [RolesController::class, 'destroy'])->name('role.destroy');
    /*   
  Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/data', [RoleController::class, 'getData'])->name('roles.data');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy'); */
});

require __DIR__ . '/auth.php';
