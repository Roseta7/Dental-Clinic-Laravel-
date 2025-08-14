<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Receptionist\DashboardController;
use Spatie\Permission\Models\Role;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');