@extends('layouts.app')

@section('title', 'Accountant Dashboard')

@push('styles')
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboards/accountant.css') }}">
@endpush

@section('content')
	<h2 class="header-title mb-4">
		Welcome Back <span>{{ $accountantName }}</span>
	</h2>

	<!-- Cards -->
	<div class="dashboard p-3">
		<!-- Card 1 -->
		<div class="card">
			<div class="header">
				<div class="icon"><i class="fa-solid fa-dollar-sign"></i></div>
			</div>
			<div class="value">{{ $weeklyRevenue }}</div>
			<div class="percent">Total Revenue This week</div>
		</div>

		<!-- Card 2 -->
		<div class="card">
			<div class="header">
				<div class="icon"><i class="fas fa-cash-register"></i></div>
			</div>
			<div class="value">{{ $weeklyPayments }}</div>
			<div class="percent">Payments Received This week</div>
		</div>

		<!-- Card 3 -->
        <div class="card">
			<div class="header">
				<div class="icon"><i class="fas fa-coins"></i></div>
			</div>
			<div class=" flex-wrap ">
				<div class="value " style="font-size: 20px;">
					<span style="font-size: 20px; margin: 0;">Total:</span>{{ $unpaidInvoicesTotal }}
				</div>
				<div class="value" style="font-size: 15px; margin: 0;">
					<span style="font-size: 15px; margin: 0;">Num:</span> {{ $unpaidInvoicesCount }}
				</div>
			</div>
			<div class="percent">Unpaid Invocies</div>
        </div>

		<!-- Card 4 -->
        <div class="card">
			<div class="header">
				<div class="icon"><i class="fas fa-pills"></i></div>
			</div>
			<div class="flex-wrap">
				<div class="value" style="font-size: 20px;">{{ $topTreatment['treatment'] ?? 'No data' }}</div>
				<div class="value" style="font-size: 15px; margin: 0;">
					<span style="font-size: 15px; margin: 0;">{{ isset($topTreatment['percentage']) ? $topTreatment['percentage'] . '%' : '-' }}</span>
				</div>
			</div>
			<div class="percent">Top Treatment</div>
        </div>
	</div>


	<!-- Invoice Details & Revenue Growth -->
	<div class="mb-4">
		<div class="row g-4 align-items-stretch">
			<div class="col-12 col-lg-6 d-flex">
				<div class="dark-table p-3 w-100">
					<h5>Invoice Details for the past three days</h5>
					<div class="table-responsive">
						<table class="table text-center mb-0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Patient Name</th>
									<th>Healer Dentist</th>
									<th>Date</th>
									<th>Total Bill</th>
									<th>Status</th>
									<th>Payment Methode</th>
								</tr>
							</thead>
							<tbody>
								@foreach($recentInvoices as $invoice)
									<tr>
										<td>{{ $invoice->id }}</td>
										<td>{{ optional(optional($invoice->appointment)->patient)->patient_name ?? '-'}}</td>
										<td>{{ optional(optional(optional($invoice->appointment)->dentist)->user)->name ?? optional(optional($invoice->appointment)->dentist)->name ?? '-' }}</td>
										<td>{{ optional($invoice->created_at)->format('Y-m-d') ?? '-' }}</td>
										<td>{{ number_format($invoice->totalbill ?? 0, 2) }}</td>
										<td>{{ ucfirst($invoice->paymentStatus ?? $invoice->status ?? 'unknown') }}</td>
										<td>{{ ucfirst($invoice->paymentMethode ?? $invoice->payment_methode ?? '-') }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<nav aria-label="Page navigation example" class="d-flex justify-content-end mt-3">
						<ul class="pagination mb-0">
								
							<!-- Previous Button -->
							@if ($recentInvoices->onFirstPage())
								<li class="page-item">
									<span class="page-link">Previous</span>
								</li>
							@else
								<li class="page-item">
									<a class="page-link" href="{{ $recentInvoices->previousPageUrl() }}">Previous</a>
								</li>
							@endif

							<!-- Page Buttons -->
							@for ($i = 1; $i <= $recentInvoices->lastPage(); $i++)
								<li class="page-item {{ $recentInvoices->currentPage() == $i ? 'active' : '' }}">
									<a class="page-link" href="{{ $recentInvoices->url($i) }}">{{ $i }}</a>
								</li>
							@endfor

							<!-- Next Button -->
							@if ($recentInvoices->hasMorePages())
								<li class="page-item">
									<a class="page-link" href="{{ $recentInvoices->nextPageUrl() }}">Next</a>
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
				<div class="card1 w-100 " style="background-color: #111827; color: white; border-radius: .5rem;">
					<div class="chart-header">
						<h5 class="mb-0 p-3">Revenue Growth</h5>
					</div>
					<div class="container1">
						<div class="chart-container" style="padding-bottom: 60%;">
							<canvas id="myChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Revenue By Type Of Treatment & Table Monthly Revenue Leaders -->
	<div>
		<div class="row g-4 align-items-stretch">
			<div class="col-12 col-lg-6 d-flex">
				<div class="dark-table p-3 w-100">
					<h5>Monthly Revenue Leaders</h5>
					<h6 class="py-0 my-0">" Top 5 doctors based on revenue generated this month "</h6>
					<div class="table-responsive">
						<table class="table text-center mb-0">
							<thead>
								<tr>
									<th>Rank</th>
									<th>Dentist</th>
									<th>Treatments</th>
									<th>Revenue</th>
									<th>Commission</th>
									<th>Payout</th>
								</tr>
							</thead>
							<tbody>
								@foreach($topDoctors as $doctor)
									<tr>
										<td>
											{{ $doctor['rank'] }}
											@if($doctor['rank'] == 1)
												<img src="{{ asset('images/medal-1.svg') }}" alt="Gold">
											@elseif($doctor['rank'] == 2)
												<img src="{{ asset('images/medal-2.svg') }}" alt="Silver">
											@elseif($doctor['rank'] == 3)
												<img src="{{ asset('images/medal-3.svg') }}" alt="Bronze">
											@endif
										</td>
										<td>{{ $doctor['dentist_name'] }}</td>
										<td>{{ $doctor['treatments'] }}</td>
										<td>{{ number_format($doctor['revenue'], 2) }}</td>
										<td>{{ $doctor['commission'] }}</td>
										<td>{{ number_format($doctor['payout'], 2) }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 d-flex">
				<div class="card1 flex-fill p-3" style="background-color: #111827; color: white; border-radius: .5rem;">
					<h5 class="mb-4 ">Revenue Distribution by Treatment Type</h5>

					<!-- Pie chart -->
					<div class="chart-wrapper-horizontal">
						<div class="chart-box">
							<canvas id="statusChart" width="300" height="300"></canvas>
							<!-- <div class="total-reports">1240<br>Total Reports</div> -->
						</div>
						<div class="legend-box">
							<div class="legend-item">
								<div class="color-box" style="background: linear-gradient(#8A9AFE, #6366F1);"></div>
								<div class="label-text">Oral Surgery </div>
							</div>
							<div class="legend-item">
								<div class="color-box" style="background: linear-gradient(#FDE68A, #FACC15);"></div>
								<div class="label-text">Orthodontics</div>
							</div>
							<div class="legend-item">
								<div class="color-box" style="background: linear-gradient(#6EE7B7, #4ADE80);"></div>
								<div class="label-text">Restorative</div>
							</div>
							<div class="legend-item">
								<div class="color-box" style="background: linear-gradient(#FCA5A5, #F87171);"></div>
								<div class="label-text">Endodontics</div>
							</div>
							<div class="legend-item">
								<div class="color-box" style="background: linear-gradient(#faa8d1, #ec4899);"></div>
								<div class="label-text">Periodontics</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const pieData = @json($pieData);
        const chartData = @json($chartData);
    </script>
    <script src="{{ asset('js/charts/accountant_charts.js') }}"></script>
@endpush
