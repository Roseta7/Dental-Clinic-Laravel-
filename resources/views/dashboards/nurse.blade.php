@extends('layouts.app')

@section('title', 'Nurse Dashboard')

@push('styles')
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboards/nurse.css') }}">
@endpush

@section('content')
    <div class="mb-3">
        <div class="row g-3 cards">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card one shadow-sm h-100">
                    <div class="card-body">
                        <i class="fa-solid fa-stethoscope stat-icon"></i>
                        <div>
                            <h5 class="mb-0">{{ $dentistsWithAppointmentsToday }}</h5>
                            <small class="text-muted">Today Dentists</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card four shadow-sm h-100">
                    <div class="card-body">
                        <i class="fa-solid fa-hospital-user stat-icon"></i>
                        <div>
                            <h5 class="mb-0">{{ $patientsWithAppointmentsToday }}</h5>
                            <small class="text-muted">Patients</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card three shadow-sm h-100">
                    <div class="card-body">
                        <i class="fa-solid fa-hospital stat-icon"></i>
                        <div>
                            <h5 class="mb-0">{{ $emergencyCasesToday }}</h5>
                            <small class="text-muted">Emergencies</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card two shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-heart-pulse stat-icon"></i>
                        <div>
                            <h5 class="mb-0">{{ $surgeryTreatmentsToday }}</h5>
                            <small class="text-muted">Surgeries</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Patients & Total Services -->
    <div class="mb-4">
        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-lg-6 d-flex">
                <div class="dark-table p-3 w-100">
                    <h5>Today's Patients</h5>
                    <div class="table-responsive">
                        <table class="table text-center mb-0">
                            <thead>
                                <tr>
                                    <th>Dentist Name</th>
                                    <th>Patient Name</th>
                                    <th>Visit Type</th>
                                    <th>Appointment Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patientsToday as $patients)
                                    <tr>
                                        <td>{{ $patients->dentist->user->name }}</td>
                                        <td>{{ $patients->patient->patient_name }}</td>
                                        <td>{{ $patients->visit_type }}</td>
                                        <td>{{ $patients->appointment_time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end mt-3">
                        <ul class="pagination mb-0">
                                
                            <!-- Previous Button -->
                            @if ($patientsToday->onFirstPage())
                                <li class="page-item">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $patientsToday->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif

                            <!-- Page Buttons -->
                            @for ($i = 1; $i <= $patientsToday->lastPage(); $i++)
                                <li class="page-item {{ $patientsToday->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $patientsToday->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Next Button -->
                            @if ($patientsToday->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $patientsToday->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex">
                <div class="card p-3 h-100 w-100" style="background-color: #111827; color: white; border-radius: .5rem;">
                    <h5 class="mb-4">Total Services</h5>
                    <div class="chart-container bar">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patients &  Table -->
    <div>
        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-lg-6 d-flex">
                <div class="dark-table p-3 w-100">
                    <h5>Today's Treatment</h5>
                    <div class="table-responsive">
                        <table class="table text-center mb-0">
                            <thead>
                                <tr>
                                    <th>Dentist Name</th>
                                    <th>Patient Name</th>
                                    <th>Treatment Type</th>
                                    <th>Treatment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($treatmentsToday as $treatments)
                                    <tr>
                                        <td>{{ $treatments->dentist->user->name }}</td>
                                        <td>{{ $treatments->patient->patient_name }}</td>
                                        <td>{{ $treatments->treatment_type }}</td>
                                        <td>{{ $treatments->treatment_status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end mt-3">
                        <ul class="pagination mb-0">

                            <!-- Previous Button -->
                            @if ($treatmentsToday->onFirstPage())
                                <li class="page-item">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $treatmentsToday->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif

                            <!-- Page Buttons -->
                            @for ($i = 1; $i <= $treatmentsToday->lastPage(); $i++)
                                <li class="page-item {{ $treatmentsToday->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $treatmentsToday->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Next Button -->
                            @if ($treatmentsToday->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $treatmentsToday->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex">
                <div class="card flex-fill p-3" style="background-color: #111827; color: white; border-radius: .5rem;">
                    <h5 class="mb-4">Patients</h5>
                    <div class="d-flex align-items-center justify-content-around flex-wrap w-100">
                        <div style="width:230px; height:230px;">
                            <canvas id="patientsChart"></canvas>
                        </div>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                Total patients: <strong>{{ $totalPatients }}</strong></li>
                            <li class="d-flex align-items-center">
                                <span class="me-2" style="width:12px; height:12px; background:#f7b6b2;"></span>
                                Regular Patient: {{ $regularPatientCount }}
                            </li>
                            <li class="d-flex align-items-center">
                                <span class="me-2" style="width:12px; height:12px; background:#b2f0e3;"></span>
                                Consultation: {{ $consultationCount }}
                            </li>
                            <li class="d-flex align-items-center">
                                <span class="me-2" style="width:12px; height:12px; background:#ffe680;"></span>
                                Emergency Aid: {{ $emergencyAidCount }}
                            </li>
                            <li class="d-flex align-items-center">
                                <span class="me-2" style="width:12px; height:12px; background:#c6d8f2;"></span>
                                Follow Up: {{ $followupCount }}
                            </li>
                            <li class="d-flex align-items-center">
                                <span class="me-2" style="width:12px; height:12px; background:#d3b2f0;"></span>
                                Treatment: {{ $typetreatmentCount }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const visitTypeStats = @json($visitTypeStats);
        const treatmentPercentages = @json($treatmentPercentages);
    </script>
    <script src="{{ asset('js/charts/nurse_charts.js') }}"></script>
@endpush