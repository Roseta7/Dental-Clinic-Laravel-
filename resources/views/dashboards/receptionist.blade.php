@extends('layouts.app')

@section('title', 'Receptionist Dashboard')

@push('styles')
	<link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon">
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

	<link rel="stylesheet" href="{{ asset('css/dashboards/receptionist.css') }}">
@endpush

@section('content')
	<main class="content p-2">
		<div class="mb-3 py-4 px-4 content-hed border rounded">
			<h3 class="fw-blod fs-4 mb-3">
			Welcome Back <span>{{ $receptionistName }}</span>
			</h3>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card  card-h  mb-3  shadow">
						<div class="card-body d-flex justify-content-center align-items-center py-1">
							<div class="stat-icon  one">
								<i class="fa-solid fa-hospital-user fs-3 "></i>
							</div>
							<div>
								<h5 class="fw-bold mb-2">
									Patients Today
								</h5>
								<p class="fw-bold mb-2 numb">
									{{ $patientsCount }}
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-3">
					<div class="card card-h mb-3  shadow">
						<div class="card-body d-flex  justify-content-center align-items-center py-1">
							<div class="stat-icon two">
								<i class="fa-solid fa-stethoscope fs-3 icone-1"></i>
							</div>
							<div>
								<h5 class="fw-bold mb-2">
									Doctors Needed
								</h5>
								<p class="fw-bold mb-2 numb">
									{{ $dentistCount }}
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card card-h mb-3  shadow ">
						<div class="card-body d-flex  justify-content-center align-items-center py-1">
							<div class="stat-icon three">
								<i class="fa-solid fa-calendar-days fs-3 icon-2"></i>
							</div>
							<div>
								<h5 class="fw-bold mb-2">
									Today's Appointments
								</h5>
								<p class="fw-bold mb-2 numb">
									{{ $totalAppointment }}
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card card-h1  mb-3">
						<div class="card-body d-flex  justify-content-center align-items-center py-1">
							<div class="stat-icon four">
								<i class="fa-regular fa-calendar-xmark fs-3 icon-3"></i>
							</div>
							<div>
								<h5 class="fw-bold mb-2 ">
									Cancelled Appointments
								</h5>
								<p class="fw-bold mb-2 numb">
									{{ $cancelledAppointments }}
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-7 content-tab table-responsive rounded ml-2">
				<h3 class="fw-bold fs-4 mb-3  my-3">Today's Appointments details</h3>
				<div class="table-scroll-container">
					<table class="table border-0 mb-0 text-center table-hover">
						<thead>
							<tr class="rounded">
							<th scope="col">Dentist</th>
							<th scope="col">Patient</th>
							<th scope="col">Time</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($todayAppointments as $appointments)
								<tr data-id="{{ $appointments->id }}">
									<td>{{ $appointments->dentist->user->name }}</td>
									<td>{{ $appointments->patient->patient_name }}</td>
									<td>{{ $appointments->appointment_time }}</td>
									<td class="status">{{ ucfirst($appointments->appointment_status) }}</td>
									<td>
										<button class="action-btn mr-3 completed-btn change-status" data-status="completed" title="Completed">
											<i class="fas fa-check "></i>
										</button>
										
										<button class="action-btn cancelled-btn change-status" data-status="cancelled" title="Cancelled">
											<i class="fas fa-times"></i>
										</button>
									
										<button class="action-btn rescheduled-btn change-status" data-status="rescheduled" title="Reschedule">
											<i class="fas fa-redo"></i>
										</button>
									
										<button class="action-btn inprogress-btn mt-1 change-status" data-status="in-progress" title="In Progress">
											<i class="fas fa-spinner fa-spin"></i>
										</button>

										<button class="action-btn upcoming-btn change-status" data-status="upcoming" title="Upcoming">
											<i class="fas fa-calendar-alt"></i>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<nav aria-label="Page navigation example" class="d-flex justify-content-end mt-3">
					<ul class="pagination mb-2">

						<!-- Previous Button -->
						@if ($todayAppointments->onFirstPage())
							<li class="page-item">
								<span class="page-link">Previous</span>
							</li>
						@else
							<li class="page-item">
								<a class="page-link" href="{{ $todayAppointments->previousPageUrl() }}">Previous</a>
							</li>
						@endif

						<!-- Page Buttons -->
						@for ($i = 1; $i <= $todayAppointments->lastPage(); $i++)
							<li class="page-item {{ $todayAppointments->currentPage() == $i ? 'active' : '' }}">
								<a class="page-link" href="{{ $todayAppointments->url($i) }}">{{ $i }}</a>
							</li>
						@endfor

						<!-- Next Button -->
						@if ($todayAppointments->hasMorePages())
							<li class="page-item">
								<a class="page-link" href="{{ $todayAppointments->nextPageUrl() }}">Next</a>
							</li>
						@else
							<li class="page-item disabled">
								<span class="page-link">Next</span>
							</li>
						@endif
					</ul>
				</nav>
			</div>
			<div class="col-12 col-lg-5">
				<div class="  h-100 card card-chart">
					<div class="card-header">
						<h4 class="card-title"> Today's Appointments by hour</h4>
					</div>
					<div id="chart-container">
						<canvas id="barChart"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-7 mt-3 content-tab table-responsive rounded">
				<h3 class="fw-bold fs-4 my-3">Today's Patients</h3>
				<h6 class="py-0 my-0">" Info of patients who have appointment today "</h6>
				<div class="table-scroll-container">
					<table class="table mb-0 text-center table-hover">
						<thead>
							<tr>
								<th scope="col">Patient Name</th>
								<th scope="col">Gender</th>
								<th scope="col">Phone</th>
								<th scope="col">Birth Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($patientsWithAppointmentsToday as $patients)
								<tr>
									<td>{{ $patients->patient_name }}</td>
									<td>{{ $patients->patient_gender }}</td>
									<td>{{ $patients->patient_phone }}</td>
									<td>{{ $patients->date_of_birth }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<nav aria-label="Page navigation example" class="d-flex justify-content-end mt-3">
					<ul class="pagination mb-2">

						<!-- Previous Button -->
						@if ($patientsWithAppointmentsToday->onFirstPage())
							<li class="page-item">
								<span class="page-link">Previous</span>
							</li>
						@else
							<li class="page-item">
								<a class="page-link" href="{{ $patientsWithAppointmentsToday->previousPageUrl() }}">Previous</a>
							</li>
						@endif

						<!-- Page Buttons -->
						@for ($i = 1; $i <= $patientsWithAppointmentsToday->lastPage(); $i++)
							<li class="page-item {{ $patientsWithAppointmentsToday->currentPage() == $i ? 'active' : '' }}">
								<a class="page-link" href="{{ $patientsWithAppointmentsToday->url($i) }}">{{ $i }}</a>
							</li>
						@endfor

						<!-- Next Button -->
						@if ($patientsWithAppointmentsToday->hasMorePages())
							<li class="page-item">
								<a class="page-link" href="{{ $patientsWithAppointmentsToday->nextPageUrl() }}">Next</a>
							</li>
						@else
							<li class="page-item disabled">
								<span class="page-link">Next</span>
							</li>
						@endif
					</ul>
				</nav>
			</div>
			<div class="col-12 col-lg-5">
				<div class=" mt-3 card card-chart">
					<div class="card-header">
						<h4 class="card-title"> Today's Appointments by hour</h4>
					</div>
					<div id="container">
						<div id="chart-container1">
							<canvas id="myChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection

@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script src="{{ asset('js/change_appointment_status.js') }}"></script>

	<script>
        const appointmentsByHour = @json($appointmentsByHour);
        const appointmentsByStatus = @json($appointmentsByStatus);
    </script>

    <script src="{{ asset('js/charts/receptionist_charts.js') }}"></script>
@endpush