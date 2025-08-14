<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radiograph;
use App\Models\Appointment;
use App\Http\Requests\RadiographRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class RadiographController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(Radiograph::class, 'radiograph');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $radiographs = Radiograph::with(['appointment.patient', 'appointment.dentist'])
                        ->visibleTo(auth()->user())
                        ->latest()
                        ->get();

            return view('radiograph.index', compact('radiographs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = Appointment::with('patient','dentist')
                        ->orderBy('appointment_date', 'desc')
                        ->get();
        return view('radiograph.create', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RadiographRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $path = $image->store('radiographs', 'public'); // inside storage/app/public/radiographs

            $data['image_path'] = $path; //EX: radiographs/xray_001.jpg
        }
        
        Radiograph::create($data);

        return to_route('radiographs.index')
            ->with('success','Radiography Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Radiograph $radiograph)
    {
        return view('radiograph.show',compact('radiograph'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Radiograph $radiograph)
    {
        $appointments = Appointment::with('patient','dentist')
                        ->orderBy('appointment_date', 'desc')
                        ->get();

        return view('radiograph.edit', compact('radiograph', 'appointments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RadiographRequest $request, Radiograph $radiograph)
    {
        $data = $request->validated();

        if ($request->hasFile('image')){
            //
            if ($radiograph->image_path && Storage::disk('public')->exists($radiograph->image_path)) {
                Storage::disk('public')->delete($radiograph->image_path);
            }

            $path = $request->file('image')->store('radiographs', 'public');
            $data['image_path'] = $path;
        }
        $radiograph->update($data);

        return to_route('radiographs.index',$radiograph)
        ->with('success','Radiography Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Radiograph $radiograph)
    {
        if ($radiograph->image_path && \Storage::disk('public')->exists($radiograph->image_path)) {
            \Storage::disk('public')->delete($radiograph->image_path);
        }

        $radiograph->delete();

        return to_route('radiographs.index')
        ->with('success', 'Radiography deleted successfully.');

    }
}
