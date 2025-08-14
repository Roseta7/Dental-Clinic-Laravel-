<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RadiographController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\DoctorNoteController;
use App\Http\Controllers\AuditLogController;


Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/about_us','about')->name('about');
    Route::get('/services','services')->name('services');
    Route::get('/contact','contact')->name('contact');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::resource('treatments', TreatmentController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('radiographs', RadiographController::class);
    Route::resource('medicalhistories', MedicalHistoryController::class);
    Route::resource('doctornotes', DoctorNoteController::class);
    Route::resource('audit-logs', AuditLogController::class)->only(['index', 'show']);
    Route::get('/treatments/{id}/procedures', function($id) {
        $treatment = App\Models\Treatment::findOrFail($id);
        return response()->json([$treatment->treatment_procedure]);
    });
});