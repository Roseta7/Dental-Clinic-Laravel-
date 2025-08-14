<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nurse\DashboardController;
use Spatie\Permission\Models\Role;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');