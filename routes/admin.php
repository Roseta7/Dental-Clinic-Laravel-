<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Spatie\Permission\Models\Role;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');