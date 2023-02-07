<?php

use App\Http\Controllers\Admin\CashflowController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PiutangController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SetoranController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ApprovalController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes();

Route::get('email/approval', [ApprovalController::class, 'show'])->name('approval.notice');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'approved']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Piutang
    Route::post('piutangs/csv', [PiutangController::class, 'csvStore'])->name('piutangs.csv.store');
    Route::put('piutangs/csv', [PiutangController::class, 'csvUpdate'])->name('piutangs.csv.update');
    Route::resource('piutangs', PiutangController::class, ['except' => ['store', 'update', 'destroy']]);

    // Setoran
    Route::post('setorans/csv', [SetoranController::class, 'csvStore'])->name('setorans.csv.store');
    Route::put('setorans/csv', [SetoranController::class, 'csvUpdate'])->name('setorans.csv.update');
    Route::resource('setorans', SetoranController::class, ['except' => ['store', 'update', 'destroy']]);

    // Cashflow
    Route::post('cashflows/csv', [CashflowController::class, 'csvStore'])->name('cashflows.csv.store');
    Route::put('cashflows/csv', [CashflowController::class, 'csvUpdate'])->name('cashflows.csv.update');
    Route::resource('cashflows', CashflowController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
