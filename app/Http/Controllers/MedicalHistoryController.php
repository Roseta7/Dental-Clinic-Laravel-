<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalHistory;
use App\Models\Treatment;
use App\Http\Requests\MedicalHistoryRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MedicalHistoryController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(MedicalHistory::class, 'medicalhistory');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalhistories = MedicalHistory::with(['treatment.appointment', 'treatment.appointment.patient', 'treatment.appointment.dentist'])
                        ->visibleTo(auth()->user())
                        ->latest()
                        ->get();

        return view('medicalhistory.index', compact('medicalhistories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $treatments = Treatment::with('appointment.patient','appointment.dentist')
                        ->orderBy('treatment_date', 'desc')
                        ->get();

        return view('medicalhistory.create', compact('treatments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicalHistoryRequest $request)
    {
        $data = $request->validated();
        
        MedicalHistory::create($data);

        return to_route('medicalhistories.index')
            ->with('success','Medical History Record Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalHistory $medicalhistory)
    {
        return view('medicalhistory.show',compact('medicalhistory'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalHistory $medicalhistory)
    {
        $treatments = Treatment::with('appointment.patient','appointment.dentist')
                        ->orderBy('treatment_date', 'desc')
                        ->get();

        return view('medicalhistory.edit', compact('medicalhistory', 'treatments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicalHistoryRequest $request, MedicalHistory $medicalhistory)
    {
        $medicalhistory->update($request->validated());

        return to_route('medicalhistories.index',$medicalhistory)
        ->with('success','Medical History Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalHistory $medicalhistory)
    {
        $medicalhistory->delete();

        return to_route('medicalhistories.index')
        ->with('success', 'Medical History Record deleted successfully.');
    }
}
