<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Appointment;
use App\Http\Requests\TreatmentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TreatmentController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(Treatment::class, 'treatment');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatments = Treatment::with(['appointment.patient', 'appointment.dentist'])
                        ->visibleTo(auth()->user())
                        ->latest()
                        ->get();

        return view('treatment.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = Appointment::with('patient','dentist')
                        ->orderBy('appointment_date', 'desc')
                        ->get();
        return view('treatment.create', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TreatmentRequest $request)
    {
        $data = $request->validated();
        
        Treatment::create($data);

        return to_route('treatments.index')
            ->with('success','Treatment Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
    return view('treatment.show',compact('treatment'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
            $appointments = Appointment::with('patient','dentist')
                            ->orderBy('appointment_date', 'desc')
                            ->get();
        
        return view('treatment.edit', compact('treatment','appointments'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TreatmentRequest $request, Treatment $treatment)
    {
        $treatment->update($request->validated());

        return to_route('treatments.index',$treatment)
        ->with('success','Treatment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return to_route('treatments.index')
        ->with('success', 'Treatment deleted successfully.');
    }
}
