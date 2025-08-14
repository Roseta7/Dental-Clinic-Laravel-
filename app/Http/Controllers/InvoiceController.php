<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Appointment;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InvoiceController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(Invoice::class, 'invoice');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with(['appointment.patient', 'appointment.dentist'])
                        ->visibleTo(auth()->user())
                        ->latest()
                        ->get();

        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = Appointment::with('patient', 'dentist')
                        ->orderBy('appointment_date', 'desc')
                        ->get();

        return view('invoice.create', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $data = $request->validated();   

        Invoice::create($data);

        return to_route('invoices.index')
            ->with('success','Invoice Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoice.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $appointments = Appointment::with('patient', 'dentist')
                        ->orderBy('appointment_date', 'desc')
                        ->get();

        return view('invoice.edit', compact('invoice','appointments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return to_route('invoices.index',$invoice)
        ->with('success','Invoice Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return to_route('invoices.index')
                ->with('success', 'Invoice deleted successfully');
    }
}
