<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Appointment;
use DB;

class DashboardController extends Controller
{
    public function index(){

        $receptionistName = Auth::user()->name;

        //first section: Cards
        $patientsCount = Appointment::whereDate('appointment_date', today())
            ->distinct('patient_id')
            ->count('patient_id');

        $dentistCount = Appointment::whereDate('appointment_date', today())
            ->distinct('dentist_id')
            ->count('dentist_id');

        $totalAppointment = Appointment::whereDate('appointment_date', today())
            ->count();

        $cancelledAppointments = Appointment::whereDate('appointment_date', today())
            ->where('appointment_status', 'cancelled')
            ->count();

        //secound section: tables
        $todayAppointments = Appointment::with(['patient', 'dentist'])
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->paginate(7, ['*'], 'appointments_page');

        $patientsWithAppointmentsToday = Patient::whereHas('appointments', function ($query) {
            $query->whereDate('appointment_date', today());
        })->paginate(5, ['*'], 'patients_page');

        //Third section: Charts

        $appointmentsByHour = Appointment::selectRaw('HOUR(appointment_time) as hour, COUNT(*) as total')
            ->whereDate('appointment_date', today())
            ->groupBy(DB::raw('HOUR(appointment_time)'))
            ->orderBy('hour')
            ->get();

        $appointmentsByStatus = Appointment::select('appointment_status', DB::raw('COUNT(*) as total'))
            ->whereBetween('appointment_time', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('appointment_status')
            ->get();

        return view('dashboards.receptionist', compact(
            'receptionistName',
            'patientsCount',
            'dentistCount',
            'totalAppointment',
            'cancelledAppointments',
            'todayAppointments',
            'patientsWithAppointmentsToday',
            'appointmentsByHour',
            'appointmentsByStatus'
        ));
    }
}
