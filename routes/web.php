<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\ClientController;
use App\Http\Middleware\EnsureAdminExists;
use App\Http\Middleware\CheckIfApproved;
use App\Http\Middleware\ClientMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(EnsureAdminExists::class, CheckIfApproved::class)->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    })->middleware('auth');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/owner-approval', [UserController::class, 'ownerApproval'])->name('owner.approval');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Routes
Route::resource('users', UserController::class);
Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');

// Vehicle Routes
Route::resource('vehicles', VehicleController::class);

// Violation Routes
Route::resource('violations', ViolationController::class)->except(['show']);
Route::get('/violations/paid', [ViolationController::class, 'paid'])->name('violations.paid');
Route::get('/violations/pending', [ViolationController::class, 'pending'])->name('violations.pending');
Route::patch('/violations/{violation}/pay', [ViolationController::class, 'pay'])->name('violations.pay');

Route::get('/register/admin', [AdminController::class, 'create'])->name('register.admin');
Route::post('/register/admin', [AdminController::class, 'store'])->name('register.admin.store');

Route::middleware(['auth', ClientMiddleware::class])->group(function () {
    Route::get('/my-vehicles', [ClientController::class, 'myVehicles'])->name('client.my_vehicles');
    Route::post('/my-vehicles', [ClientController::class, 'store'])->name('client.store_vehicle');
    Route::get('/my-vehicles/create', [ClientController::class, 'createVehicle'])->name('client.create_vehicle');
    Route::get('/my-violations', [ClientController::class, 'myViolations'])->name('client.my_violations');
});

require __DIR__.'/auth.php';
