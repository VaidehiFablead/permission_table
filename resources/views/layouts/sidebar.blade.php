<!-- Sidebar -->
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
    @if (app('hasPermission')(1, 'view'))
        <li class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Modules</div>

    {{-- ================= STAFF MODULE (module_id = 2) ================= --}}
    @if (app('hasPermission')(2, 'view') || app('hasPermission')(2, 'create'))
        <li class="submenu {{ request()->routeIs('staff.*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-user-md"></i>
                <span>Staff</span>
                <span class="menu-arrow"></span>
            </a>

            <ul style="{{ request()->routeIs('staff.*') ? 'display:block;' : 'display:none;' }}">
                @if (app('hasPermission')(2, 'view'))
                    <li class="{{ request()->routeIs('staff.index') ? 'active' : '' }}">
                        <a href="{{ route('staff.index') }}">
                            <i class="fa fa-users icons"></i> All Staff
                        </a>
                    </li>
                @endif

                @if (app('hasPermission')(2, 'create'))
                    <li class="{{ request()->routeIs('staff.create') ? 'active' : '' }}">
                        <a href="{{ route('staff.create') }}">
                            <i class="fa fa-user-plus icons"></i> Add Staff
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif


    {{-- ================= PATIENT MODULE (module_id = 3) ================= --}}
    @if (app('hasPermission')(3, 'view') || app('hasPermission')(3, 'create'))
        <li class="submenu {{ request()->routeIs('patient.*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-procedures"></i>
                <span>Patients</span>
                <span class="menu-arrow"></span>
            </a>

            <ul style="{{ request()->routeIs('patient.*') ? 'display:block;' : 'display:none;' }}">
                @if (app('hasPermission')(3, 'view'))
                    <li class="{{ request()->routeIs('patient.index') ? 'active' : '' }}">
                        <a href="{{ route('patient.index') }}">All Patients</a>
                    </li>
                @endif
                @if (app('hasPermission')(3, 'create'))
                    <li class="{{ request()->routeIs('patient.create') ? 'active' : '' }}">
                        <a href="{{ route('patient.create') }}">Add Patient</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif


    {{-- ================= TREATMENT MODULE (module_id = 4) ================= --}}
    @if (app('hasPermission')(4, 'view') || app('hasPermission')(4, 'create'))
        <li class="submenu {{ request()->routeIs('treatment.*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-stethoscope"></i>
                <span>Treatment</span>
                <span class="menu-arrow"></span>
            </a>

            <ul style="{{ request()->routeIs('treatment.*') ? 'display:block;' : 'display:none;' }}">
                @if (app('hasPermission')(4, 'view'))
                    <li><a href="{{ route('treatment.index') }}">All Treatments</a></li>
                @endif

                @if (app('hasPermission')(4, 'create'))
                    <li><a href="{{ route('treatment.create') }}">Add Treatment</a></li>
                @endif
            </ul>
        </li>
    @endif


    {{-- ================= APPOINTMENT MODULE (module_id = 5) ================= --}}
    @if (app('hasPermission')(5, 'view') || app('hasPermission')(5, 'create'))
        <li class="submenu {{ request()->routeIs('appointment.*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-calendar-check"></i>
                <span>Appointments</span>
                <span class="menu-arrow"></span>
            </a>

            <ul style="{{ request()->routeIs('appointment.*') ? 'display:block;' : 'display:none;' }}">
                @if (app('hasPermission')(5, 'view'))
                    <li><a href="{{ route('appointment.index') }}">All Appointments</a></li>
                @endif

                @if (app('hasPermission')(5, 'create'))
                    <li><a href="{{ route('appointment.create') }}">Add Appointment</a></li>
                @endif
            </ul>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->
