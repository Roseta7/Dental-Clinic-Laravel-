<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AppointmentController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(Appointment::class, 'appointment');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['patient','dentist'])
                        ->visibleTo(auth()->user())
                        ->latest()
                        ->get();

        return view('appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        
        $dentists = User::role('dentist')->get();

        return view('appointment.create', compact('patients','dentists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();
        Appointment::create($data);

        return to_route('appointments.index')
            ->with('success','Appointment Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointment.show',compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        
        $dentists = User::role('dentist')->get();

        return view('appointment.edit', compact('appointment', 'patients', 'dentists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        return to_route('appointments.index',$appointment)
        ->with('success','Appointment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return to_route('appointments.index')
                ->with('success', 'Appointment deleted successfully.');
    }

    //function to modify only the appointment status from the Receptionist Dashboard.
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $validated = $request->validate([
            'appointment_status' => ['required', 'in:upcoming,completed,in-progress,cancelled,rescheduled'],
        ]);

        $appointment->update(['appointment_status' => $validated['appointment_status']]);

        return response()->json(['success' => true, 'new_status' => $appointment->appointment_status]);
    }
}
