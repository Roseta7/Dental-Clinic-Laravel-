<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorNote;
use App\Models\Treatment;
use App\Http\Requests\DoctorNoteRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DoctorNoteController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(DoctorNote::class, 'doctornote');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctornotes = DoctorNote::with(['treatment.appointment', 'treatment.appointment.patient', 'treatment.appointment.dentist'])
                        ->visibleTo(auth()->user())
                        ->latest()
                        ->get();

        return view('doctornote.index', compact('doctornotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $treatments = Treatment::with('appointment.patient','appointment.dentist')
                        ->orderBy('treatment_date', 'desc')
                        ->get();
        return view('doctornote.create', compact('treatments'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorNoteRequest $request)
    {
        $data = $request->validated();
        
        DoctorNote::create($data);

        return to_route('doctornotes.index')
            ->with('success','Note Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorNote $doctornote)
    {
        return view('doctornote.show',compact('doctornote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorNote $doctornote)
    {
        $treatments = Treatment::with('appointment.patient','appointment.dentist')
                        ->orderBy('treatment_date', 'desc')
                        ->get();

        return view('doctornote.edit', compact('doctornote', 'treatments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorNoteRequest $request, DoctorNote $doctornote)
    {
        $doctornote->update($request->validated());

        return to_route('doctornotes.index',$doctornote)
        ->with('success','Note Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorNote $doctornote)
    {
        $doctornote->delete();

        return to_route('doctornotes.index')
        ->with('success', 'Note deleted successfully.');

    }
}
