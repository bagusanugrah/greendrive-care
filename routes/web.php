<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk User Biasa
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('vehicles.index');
    })->name('dashboard');

    // Pastikan resource routes ini terdaftar agar proses CRUD form tidak error
    Route::resource('vehicles', VehicleController::class);
    Route::resource('maintenance', MaintenanceController::class);
    
    Route::get('/recycling-map', [MapController::class, 'index'])->name('map.index');
    Route::post('/recycling-map/search', [MapController::class, 'findNearest'])->name('map.search');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Khusus Admin (Akses RBAC)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';