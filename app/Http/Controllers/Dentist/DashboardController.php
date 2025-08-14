<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $dentist = auth()->user();

        $appointmentsStats = $this->getMonthlyAppointmentsStats($dentist);

        $appointmentsToday = $this->getTodayAppointments($dentist);

        $recentTreatments = $this->getRecentTreatments($dentist);

        $patientStats = $this->getPatientStats($dentist);

        $earningsStats = $this->getEarningsStats($dentist);

        return view('dashboards.dentist', compact(
            'appointmentsStats',
            'appointmentsToday',
            'recentTreatments',
            'patientStats',
            'earningsStats'
        ));
    }

    protected function getMonthlyAppointmentsStats($dentist){

        $stats = Appointment::visibleTo($dentist)
            ->selectRaw("MONTH(appointment_date) as month")
            ->selectRaw("SUM(CASE WHEN appointment_status = 'completed' THEN 1 ELSE 0 END) as completed")
            ->selectRaw("SUM(CASE WHEN appointment_status = 'cancelled' THEN 1 ELSE 0 END) as cancelled")
            ->whereYear('appointment_date', now()->year)
            ->groupByRaw("MONTH(appointment_date)")
            ->orderBy('month')
            ->get();

        // Prepare final data for each month from 1 to 12
        $completed = array_fill(0, 12, 0);
        $cancelled = array_fill(0, 12, 0);

        foreach ($stats as $row) {
            $completed[$row->month - 1] = (int) $row->completed;
            $cancelled[$row->month - 1] = (int) $row->cancelled;
        }

        return [
            'labels' => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            'completed' => $completed,
            'cancelled' => $cancelled,
        ];
    }

    protected function getTodayAppointments($dentist){

        return Appointment::visibleTo($dentist)
            ->whereDate('appointment_date', now()->toDateString())
            ->with('patient')
            ->orderBy('appointment_time')
            ->paginate(5, ['*'], 'appointments_page');
    }

    protected function getRecentTreatments($dentist){

        return Treatment::visibleTo($dentist)
            ->with(['appointment.patient', 'appointment'])
            ->latest('treatment_date')
            ->take(20)
            ->paginate(5, ['*'], 'treatments_page');
    }

    protected function getPatientStats($dentist){

        $monthCount = Appointment::visibleTo($dentist)
            ->whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year)
            ->distinct('patient_id')
            ->count('patinet_id');
        
        $yearCount = Appointment::visibleTo($dentist)
            ->whereYear('appointment_date', now()->year)
            ->distinct('patient_id')
            ->count('patinet_id');
        
        return [
            'this_month' => $monthCount,
            'this_year' => $yearCount,
        ];
    }

    protected function getEarningsStats($dentist){

        $percentage = 0.4;

        $earningsThisMonth = Invoice::visibleTo($dentist)
            ->whereMonth('paymentDate', now()->month)
            ->whereYear('paymentDate', now()->year)
            ->sum('totalbill') * $percentage;
        
        $earningsThisYear = Invoice::visibleTo($dentist)
            ->whereYear('paymentDate', now()->year)
            ->sum('totalbill') * $percentage;

        return [
            'this_month' => $earningsThisMonth,
            'this_year' => $earningsThisYear,
        ];
    }
}
