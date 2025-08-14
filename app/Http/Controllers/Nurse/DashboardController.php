<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Treatment;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index() {
        $today = Carbon::today();

        //The first section: The Cards

        $dentistsWithAppointmentsToday = Appointment::whereDate('appointment_date', $today)
            ->distinct('dentist_id')
            ->count('dentist_id');
        
        $patientsWithAppointmentsToday = Appointment::whereDate('appointment_date', $today)
            ->distinct('patient_id')
            ->count('patient_id');

        $surgeryTreatmentsToday = Treatment::whereHas('appointment', function ($q) use($today) {
            $q->whereDate('appointment_date', $today);
        })
        ->where('treatment_type', 'oral_surgery')
        ->count();

        $emergencyCasesToday = Appointment::whereDate('appointment_date', $today)
            ->where('visit_type', 'Emergency')
            ->count();

        //Section two: Charts

        $startOfMonth = $today->copy()->startOfMonth();

        //First Chart
        $visitTypeStats = Appointment::whereBetween('appointment_date', [$startOfMonth, $today])
            ->select('visit_type', DB::raw('count(*) as count'))
            ->groupBy('visit_type')
            ->pluck('count', 'visit_type');

        //Belonging to the first chart
        $totalPatients = Patient::count();
        $regularPatientCount = Appointment::where('visit_type', 'checkup')->count();
        $consultationCount = Appointment::where('visit_type', 'consultation')->count();
        $emergencyAidCount = Appointment::where('visit_type', 'emergency')->count();
        $followupCount = Appointment::where('visit_type', 'follow_up')->count();
        $typetreatmentCount = Appointment::where('visit_type', 'treatment')->count();

        //Second Chart
        $treatmentStats = Treatment::whereMonth('created_at', now()->month)
        ->select('treatment_type', DB::raw('count(*) as count'))
        ->groupBy('treatment_type')
        ->pluck('count', 'treatment_type');

        $totalTreatments = $treatmentStats->sum();
        $treatmentPercentages = $treatmentStats->map(function ($count) use ($totalTreatments) {
            return round(($count / $totalTreatments) * 100, 2);
        });

        //Section Three: Tables

        $patientsToday = Appointment::with(['patient', 'dentist'])
            ->whereDate('appointment_date', $today)
            ->paginate(5, ['*'], 'patients_page');

        $treatmentsToday = Treatment::with(['appointment.dentist', 'appointment.patient'])
            ->whereHas('appointment', function ($q) use ($today) {
                $q->whereDate('appointment_date', $today);
            })
            ->paginate(5, ['*'], 'treatments_page');

        return view('dashboards.nurse', compact(
            'dentistsWithAppointmentsToday',
            'patientsWithAppointmentsToday',
            'surgeryTreatmentsToday',
            'emergencyCasesToday',
            'visitTypeStats',
            'totalPatients',
            'regularPatientCount',
            'consultationCount',
            'emergencyAidCount',
            'followupCount',
            'typetreatmentCount',
            'treatmentPercentages',
            'patientsToday',
            'treatmentsToday'
        ));
    }
}
