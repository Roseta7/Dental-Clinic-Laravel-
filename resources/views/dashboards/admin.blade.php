@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/dashboards/admin.css') }}">
@endpush

@section('content')
    <!-- start main -->
    <div class="header-container">
        <div class="info-admin ">
            <h1>Welcome Back <span>{{ $adminName }}</span></h1>
            <p>Access a summary of key metrics and clinic data.</p>
        </div>

        <!-- start content -->
        <div class="content ">
            <!--start cards -->
            <!-- <div class=" cards row g-4"> -->
            <div class="cards row gx-4 gy-4">

                <!-- card 1-->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

                    <div class="card  card-custom p-3">
                        <div class="stat-icon one">
                            <i class="fas fa-users"></i>
                        </div>
                        <h6 class="card-title">Total Patients</h6>
                        <div class="balance">{{ $patientsCount }}</div>
                        <canvas id="chart1" height="70"></canvas>
                    </div>
                </div>

                <!-- card 2-->
                <!-- <div class="col-md-2"> -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

                    <div class="card  card-custom p-3">
                        <div class="stat-icon two">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h6 class="card-title">Unpaid Invoices</h6>
                        <div class="balance">{{ $unpaidInvoicesCount }}</div>
                        <canvas id="chart2" height="70"></canvas>
                    </div>
                </div>

                <!-- card 3-->
                <!-- <div class="col-md-2"> -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

                    <div class="card  card-custom p-3">
                        <div class="stat-icon four">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <h6 class="card-title">Paid Invoices</h6>
                        <div class="balance">{{ $paidInvoicesCount }}</div>
                        <canvas id="chart3" height="70"></canvas>
                    </div>
                </div>

                <!-- card 4-->
                <!-- <div class="col-md-2"> -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

                    <div class="card  card-custom p-3">
                        <div class="stat-icon three">
                            <i class="fa-solid fa-pills"></i>
                        </div>
                        <h6 class="card-title">Total Treatments</h6>
                        <div class="balance">{{ $treatmentsCount }}</div>
                        <canvas id="chart4" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--end cards -->
            </div>
        <!-- end content -->
        </div>

        <!-- content-main: table and chart-->
        <div class="content-main">
            <!-- table-container-->
            <div class="table-container" >

                <div class="dark-table">
                    <h5 class="card-title mb-4">Last Modifications On Logs</h5>
                    <table class="table mb-0 text-center">
                        <thead>
                            <tr>
                                <th scope="col">User Name</th>
                                <th scope="col">Table</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestAuditLogs as $log)
                                <tr>
                                    <td class="d-flex align-items-center justify-content-center">
                                        {{ $log->user->name }}
                                    </td>
                                    <td>
                                        {{ $log->table_name }}
                                    </td>
                                    <td>
                                        <span class="badge-delete">{{ $log->action_type }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end table -->
            <!-- chart-container-->
            <div id="chart-container">
                <h5 class="card-title mb-4">Clinic Business Growth</h5>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <!-- end content-main -->
    </div>
    <!-- end main -->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.chartData = {
            monthlyTotals : @json($monthlyTotals),
            monthLabels : [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ],
            trends: {
                patients: @json($chartTrends['patientsTrend']),
                unpaid: @json($chartTrends['unpaidTrend']),
                paid: @json($chartTrends['paidTrend']),
                treatments: @json($chartTrends['treatmentsTrend']),
            }
        };
    </script>
    <script src="{{ asset('js/charts/admin_charts.js') }}"></script>
@endpush
