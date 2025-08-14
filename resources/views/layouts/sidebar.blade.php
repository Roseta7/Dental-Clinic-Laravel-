{{-- resources/views/layouts/sidebar.blade.php --}}
<!-- sidebar start -->
<aside id="sidebar">
    <div class="d-flex align-items-center justify-content-between p-4">
        <div class="sidebar-logo me-2"> <img src="{{ asset('images/logo.png') }}" alt="" width="30px" class="logo"> Clinic
        </div>
        <button class="toggle-btn"><i id="icon" class="bx bx-chevrons-right"></i></button>
    </div>

    <ul class="sidebar-nav">

        <!-- Create an array to check the role - (for the dashboard button)  -->
        @php
            $role = Auth::user()->getRoleNames()->first();
            $routes = [
                'admin' => 'admin.dashboard',
                'dentist' => 'dentist.dashboard',
                'receptionist' => 'receptionist.dashboard',
                'nurse' => 'nurse.dashboard',
                'accountant' => 'accountant.dashboard',
            ];
        @endphp

        <li class="sidebar-item">
            <a href="{{ isset($routes[$role]) ? route($routes[$role]) : route('home') }}" class="sidebar-link active">
                <i class="bx bx-home-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @canany(['viewAny', 'create'], App\Models\User::class)
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#users" aria-expanded="false" aria-controls="users">
                    <i class="bx bx-group"></i>
                    <span>Manage Users</span>
                </a>

                <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                    @can('viewAny', App\Models\User::class)
                        <li class="sidebar-item">
                            <a href="{{ route('users.index') }}" class="sidebar-link ">
                                ViewUsers
                            </a>
                        </li>
                    @endcan

                    @can('create', App\Models\User::class)
                        <li class="sidebar-item">
                            <a href="{{ route('users.create') }}" class="sidebar-link ">
                                Add New User
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcanany

        @can('viewAny', App\Models\AuditLog::class)
            <li class="sidebar-item">
                <a href="{{ route('audit-logs.index') }}" class="sidebar-link ">
                    <i class="bx bx-history"></i>
                    <span>View logs</span>
                </a>
            </li>
        @endcan
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#data"
                aria-expanded="false" aria-controls="data">
                <i class="bx bx-layout-search"></i>
                <span>Access All Data</span>
            </a>

            <ul id="data" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                @can('create', App\Models\Patient::class)
                    <li class="sidebar-item">
                        <a href="{{ route('patients.create') }}" class="sidebar-link ">
                            Add patient
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\Patient::class)
                    <li class="sidebar-item">
                        <a href="{{ route('patients.index') }}" class="sidebar-link ">
                            Show patients
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Appointment::class)
                    <li class="sidebar-item">
                        <a href="{{ route('appointments.create') }}" class="sidebar-link ">
                            Add Appointment
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\Appointment::class)
                    <li class="sidebar-item">
                            <a href="{{ route('appointments.index') }}" class="sidebar-link ">
                                Show Appointments
                            </a>
                    </li>
                @endcan
                @can('create', App\Models\Treatment::class)
                    <li class="sidebar-item">
                        <a href="{{ route('treatments.create') }}" class="sidebar-link ">
                            Add Treatment
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\Treatment::class)
                    <li class="sidebar-item">
                        <a href="{{ route('treatments.index') }}" class="sidebar-link ">
                            Show Treatments
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Invoice::class)
                    <li class="sidebar-item">
                        <a href="{{ route('invoices.create') }}" class="sidebar-link ">
                            Add Invoices
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\Invoice::class)
                    <li class="sidebar-item">
                        <a href="{{ route('invoices.index') }}" class="sidebar-link ">
                            Show Invoices
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Radiograph::class)
                    <li class="sidebar-item">
                        <a href="{{ route('radiographs.create') }}" class="sidebar-link ">
                            Add Radiograph
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\Radiograph::class)
                    <li class="sidebar-item">
                        <a href="{{ route('radiographs.index') }}" class="sidebar-link ">
                            Show Radiograph
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\DoctorNote::class)
                    <li class="sidebar-item">
                        <a href="{{ route('doctornotes.create') }}" class="sidebar-link ">
                            Add Dentist Note
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\DoctorNote::class)
                    <li class="sidebar-item">
                        <a href="{{ route('doctornotes.index') }}" class="sidebar-link ">
                            Show Dentist Notes
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\MedicalHistory::class)
                    <li class="sidebar-item">
                        <a href="{{ route('medicalhistories.create') }}" class="sidebar-link ">
                            Add Medical History
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\MedicalHistory::class)
                    <li class="sidebar-item">
                        <a href="{{ route('medicalhistories.index') }}" class="sidebar-link ">
                            Show Medical History
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    </ul>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" class="sidebar-link">
            @csrf
            <button type="submit"><span>logout</span></button>
            <i class="bx bx-arrow-out-left-square-half"></i>
        </form>
    </div>
</aside>
<!-- sidebar end -->