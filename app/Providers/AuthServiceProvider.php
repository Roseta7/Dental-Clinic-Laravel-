<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Patient;
use App\Policies\PatientPolicy;
use App\Models\Appointment;
use App\Policies\AppointmentPolicy;
use App\Models\Treatment;
use App\Policies\TreatmentPolicy;
use App\Models\Invoice;
use App\Policies\InvoicePolicy;
use App\Models\Radiograph;
use App\Policies\RadiographPolicy;
use App\Models\MedicalHistory;
use App\Policies\MedicalHistoryPolicy;
use App\Models\DoctorNote;
use App\Policies\DoctorNotePolicy;
use App\Models\AuditLog;
use App\Policies\AuditLogPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        User::class => UserPolicy::class,
        Patient::class => PatientPolicy::class,
        Appointment::class => AppointmentPolicy::class,
        Treatment::class => TreatmentPolicy::class,
        Invoice::class => InvoicePolicy::class,
        Radiograph::class => RadiographPolicy::class,
        MedicalHistory::class => MedicalHistoryPolicy::class,
        DoctorNote::class => DoctorNotePolicy::class,
        AuditLog::class => AuditLogPolicy::class,
    ];
}
