<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
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

    Route::get('approval_list/', [TicketsController::class, 'index'])->name('approval_list.index');
    Route::get('multiple_ticket_updates/', [TicketsController::class, 'multiple_updates'])->name('approval_list.multiple_updates');
    Route::get('transactionList/', [TicketsController::class, 'transaction_list'])->name('approval_list.transaction_list');
    Route::get('create_tickets/', [TicketsController::class, 'create'])->name('approval_list.create');
    Route::get('get_transaction_list_data/', [TicketsController::class, 'get_transaction_list_data'])->name('approval_list.get_transaction_list_data');
    Route::post('store_tickets/', [TicketsController::class, 'store'])->name('approval_list.store');
    Route::get('get_data_tickets/', [TicketsController::class, 'get_data'])->name('approval_list.get_data');
    Route::get('show_ticket/{tickets}/', [TicketsController::class, 'show'])->name('approval_list.show');
    Route::put('update_ticket/{tickets}/', [TicketsController::class, 'update'])->name('approval_list.update');
    Route::post('update_tickets_status', [TicketsController::class, 'update_tickets_status'])->name('approval_list.update_tickets_status');

    Route::get('fetch_numbers/', [DashboardController::class, 'fetch_numbers'])->name('dashboard.fetch_numbers');
    Route::get('accounting/', [AccountingController::class, 'index'])->name('accounting.index');
    Route::get('get_div_data/{id}', [AccountingController::class, 'get_div_data'])->name('accounting.get_div_data');
    Route::get('get_dept_data/{id}', [AccountingController::class, 'get_dept_data'])->name('accounting.get_dept_data');
});


require __DIR__ . '/auth.php';
