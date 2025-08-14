@extends('layouts.app')

@section('title', 'Dentist Dashboard')

@push('styles')
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboards/dentist.css') }}">
@endpush

@section('content')
    <main>
        <div class="row g-4">
                <!-- Chart Column -->
                <div class="col-lg-6">
                    <div class="chart-card">
                        <div class="mb-3 fs-5 fw-bold doctor-name">Good Morning,<span> Dr.{{ auth()->user()->name }}</span></div>
                        <div class="chart-wrapper">
                            <canvas id="appointmentsChart" data-chart='@json($appointmentsToday)'></canvas>
                        </div>
                    </div>
                </div>

            <!-- Dark Table Column -->
            <div class="table-container col-lg-6">
                <h4 class="mb-0">My Daily Appointments</h4>
                <div class="dark-table p-3 w-100">
                    <div class="table-responsive">
                        <table class="table text-center mb-0">
                            <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($appointmentsToday as $appointment)
                                    <tr>
                                        <td>{{ $appointment->patient->patient_name }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No Appointments Today</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end mt-3">
                        <ul class="pagination mb-0">
                            
                            <!-- Previous Button -->
                            @if ($appointmentsToday->onFirstPage())
                                <li class="page-item">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $appointmentsToday->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif

                            <!-- Page Buttons -->
                            @for ($i = 1; $i <= $appointmentsToday->lastPage(); $i++)
                                <li class="page-item {{ $appointmentsToday->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $appointmentsToday->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Next Button -->
                            @if ($appointmentsToday->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $appointmentsToday->nextPageUrl() }}">Next</a>
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
            <div class="dashboard-grid">
                <div class="dashboard-card treatments">
                    <h5 class="text-uppercase text-secondary ">Top Treatments</h5>
                    <div class="dark-table table-responsive treatment-table-wrapper">
                        <table class="table mb-0 text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Treatment type</th>
                                    <th scope="col">Treatment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentTreatments as $treatment)
                                    <tr>
                                        <td>{{ $treatment->appointment->patient->patient_name }}</td>
                                        <td>{{ $treatment->treatment_type }}</td>
                                        <td>{{ ucfirst($treatment->treatment_status) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end mt-3">
                        <ul class="pagination mb-0">
                            
                            <!-- Previous Button -->
                            @if ($recentTreatments->onFirstPage())
                                <li class="page-item">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $recentTreatments->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif

                            <!-- Page Buttons -->
                            @for ($i = 1; $i <= $recentTreatments->lastPage(); $i++)
                                <li class="page-item {{ $recentTreatments->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $recentTreatments->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Next Button -->
                            @if ($recentTreatments->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $recentTreatments->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="dashboard-card d-flex flex-column ">
                    <div class="mt-2">
                        <h6 class="text-uppercase text-secondary">Total Patients This Month</h6>
                        <h2 class="fw-normal mb-4 number">{{ $patientStats['this_month'] }}</h2>
                    </div>
                    <div class="mt-4">
                        <h6 class="text-uppercase text-secondary ">Total Patients This Year</h6>
                        <h2 class="fw-normal number">{{ $patientStats['this_year'] }}</h2>
                    </div>
                </div>

                <div class="dashboard-card d-flex flex-column justify-content-between ">
                    <div class="mt-2">
                        <h6 class="text-uppercase text-secondary mb-4">DOCTOR Revenue</h6>
                        <h2 class="fw-normal number">{{ $earningsStats['this_month'] }}</h2>
                        <p class="text-muted mb-6 ">This Month</p>
                        <h2 class="fw-normal number">{{ $earningsStats['this_year'] }}</h2>
                        <p class="text-muted">This Year</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<!-- Scripts -->
@push('scripts')
    <script>
        window.appointmentsChartData = {
            labels: @json($appointmentsStats['labels']),
            datasets: [
                { label: "Appointments", backgroundColor: "#a3d3f5", data: @json($appointmentsStats['completed']) },
                { label: "Cancelled", backgroundColor: "#ffe680", data: @json($appointmentsStats['cancelled']) }
            ]
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/charts/dentist_charts.js') }}"></script>
@endpush