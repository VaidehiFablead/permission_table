<!-- Sidebar -->
<style>
   ul#accordionSidebar {
    /* background: rgb(112, 8, 8); */
    /* color: #000000; */
    background: #1e555c;
}
.sidebar-dark .nav-item .nav-link i {
    color: white;
}
</style>
@php
    $hasPermission = app('hasPermission'); // Using helper only once
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    {{-- ================= Dashboard (module_id = 1) ================= --}}
    @if ($hasPermission(1, 'view'))
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fa fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider">

    <div class="sidebar-heading text-white">Modules</div>


    {{-- ============================================================
         STAFF MODULE (module_id = 2)
    ============================================================ --}}
    @if ($hasPermission(2, 'view') || $hasPermission(2, 'create'))
        <li class="nav-item {{ request()->routeIs('staff.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#staffMenu">
                <i class="fa fa-user-md"></i>
                <span>Staff</span>
            </a>

            <div id="staffMenu" class="collapse {{ request()->routeIs('staff.*') ? 'show' : '' }}">
                <div class="bg-white py-2 collapse-inner rounded">

                    @if ($hasPermission(2, 'view'))
                        <a class="collapse-item {{ request()->routeIs('staff.index') ? 'active' : '' }}" href="#">
                            {{-- {{ route('staff.index') }} --}}
                            <i class="fa fa-users"></i> All Staff
                        </a>
                    @endif

                    @if ($hasPermission(2, 'create'))
                        <a class="collapse-item {{ request()->routeIs('staff.create') ? 'active' : '' }}"
                            href="{{ route('staff.create') }}">
                            <i class="fa fa-user-plus"></i> Add Staff
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif



    {{-- ============================================================
         PATIENT MODULE (module_id = 3)
    ============================================================ --}}
    @if ($hasPermission(3, 'view') || $hasPermission(3, 'create'))
        <li class="nav-item {{ request()->routeIs('patient.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#patientMenu">
                <i class="fa fa-procedures"></i>
                <span>Patients</span>
            </a>

            <div id="patientMenu" class="collapse {{ request()->routeIs('patient.*') ? 'show' : '' }}">
                <div class="bg-white py-2 collapse-inner rounded">

                    @if ($hasPermission(3, 'view'))
                        <a class="collapse-item {{ request()->routeIs('patient.index') ? 'active' : '' }}"
                            href="#">
                            {{-- {{ route('patient.index') }} --}}
                            All Patients
                        </a>
                    @endif

                    @if ($hasPermission(3, 'create'))
                        <a class="collapse-item {{ request()->routeIs('patient.create') ? 'active' : '' }}"
                            href="#">
                            {{-- {{ route('patient.create') }} --}}
                            Add Patient
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif


    {{-- ============================================================
         TREATMENT MODULE (module_id = 4)
    ============================================================ --}}
    @if ($hasPermission(4, 'view') || $hasPermission(4, 'create'))
        <li class="nav-item {{ request()->routeIs('treatment.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#treatmentMenu">
                <i class="fa fa-stethoscope"></i>
                <span>Treatment</span>
            </a>

            <div id="treatmentMenu" class="collapse {{ request()->routeIs('treatment.*') ? 'show' : '' }}">
                <div class="bg-white py-2 collapse-inner rounded">

                    @if ($hasPermission(4, 'view'))
                        <a class="collapse-item" href="#">
                            {{-- {{ route('treatment.index') }} --}}
                            All Treatments
                        </a>
                    @endif

                    @if ($hasPermission(4, 'create'))
                        <a class="collapse-item" href="#">
                            {{-- {{ route('treatment.create') }} --}}
                            Add Treatment
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif



    {{-- ============================================================
         APPOINTMENT MODULE (module_id = 6)
    ============================================================ --}}
    @if ($hasPermission(5, 'view') || $hasPermission(5, 'create'))
        <li class="nav-item {{ request()->routeIs('appointment.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#appointmentMenu">
                <i class="fa fa-calendar-check"></i>
                <span>Appointments</span>
            </a>

            <div id="appointmentMenu" class="collapse {{ request()->routeIs('appointment.*') ? 'show' : '' }}">
                <div class="bg-white py-2 collapse-inner rounded">

                    @if ($hasPermission(5, 'view'))
                        <a class="collapse-item" href="#">
                            {{-- {{ route('appointment.index') }} --}}
                            All Appointments
                        </a>
                    @endif

                    @if ($hasPermission(5, 'create'))
                        <a class="collapse-item" href="#">
                            {{-- {{ route('appointment.create') }} --}}
                            Add Appointment
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif



    {{-- =================== report ==================== --}}
    @if ($hasPermission(6, 'view') || $hasPermission(6, 'create'))
        <li class="nav-item {{ request()->routeIs('report.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report">
                <i class="fas fa-chart-line"></i>
                <span>Report</span>
            </a>

            <div id="report" class="collapse {{ request()->routeIs('report.*') ? 'show' : '' }}">
                <div class="bg-white py-2 collapse-inner rounded">

                    @if ($hasPermission(6, 'view'))
                        <a class="collapse-item" href="{{ route('report.view') }}">
                            {{-- {{ route('appointment.index') }} --}}
                            All Report
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif

      @if ($hasPermission(7, 'view') )
        <li class="nav-item {{ request()->routeIs('openAi.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AI">
                <i class="fas fa-chart-line"></i>
                <span>open AI</span>
            </a>

            <div id="AI" class="collapse {{ request()->routeIs('openAi.*') ? 'show' : '' }}">
                <div class="bg-white py-2 collapse-inner rounded">

                    @if ($hasPermission(6, 'view'))
                        <a class="collapse-item" href="{{ route('chat.index') }}">
                            {{-- {{ route('appointment.index') }} --}}
                            Chat With me
                        </a>
                    @endif

                </div>
            </div>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->
