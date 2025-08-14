<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Patient;
use App\Observers\PatientObserver;
use App\Models\MedicalHistory;
use App\Observers\MedicalHistoryObserver;
use App\Models\Invoice;
use App\Observers\InvoiceObserver;
use App\Models\Treatment;
use App\Observers\TreatmentObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Patient::observe(PatientObserver::class);
        MedicalHistory::observe(MedicalHistoryObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Treatment::observe(TreatmentObserver::class);
    }
}
