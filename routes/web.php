<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ParcelController as AdminParcelController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ActivityLogController as AdminActivityLogController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ParcelController as UserParcelController;

Route::get('/', fn () => redirect()->route('user.login'));

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/parcels', [AdminParcelController::class, 'index'])->name('parcels');
    Route::patch('/parcels/{parcel}', [AdminParcelController::class, 'update'])->name('parcels.update');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/logs', [AdminActivityLogController::class, 'index'])->name('logs');
});

Route::get('/user/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.submit');
Route::get('/user/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [UserAuthController::class, 'register'])->name('user.register.submit');
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::middleware('user')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/parcels', [UserParcelController::class, 'index'])->name('parcels');
    Route::get('/parcels/create', [UserParcelController::class, 'create'])->name('parcels.create');
    Route::post('/parcels', [UserParcelController::class, 'store'])->name('parcels.store');
    Route::get('/parcels/{trackingNumber}', [UserParcelController::class, 'show'])->name('parcels.show');
});
Route::get('/fix-admin', function () {
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@swifttrack.com'],
        [
            'name' => 'SwiftTrack Admin',
            'password' => \Illuminate\Support\Facades\Hash::make('Admin@12345'),
            'role' => 'admin',
        ]
    );

    return 'ADMIN FIXED SUCCESSFULLY';
});