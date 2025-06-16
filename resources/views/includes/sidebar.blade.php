<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:rgb(3, 62, 129);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PlateTrack</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Vehicle Log with Dropdown -->
    @php
        $isVehicleLog = Request::is('plates*') || Request::is('vehicle-logs*');
    @endphp
    <li class="nav-item {{ $isVehicleLog ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVehicleLog"
           aria-expanded="{{ $isVehicleLog ? 'true' : 'false' }}" aria-controls="collapseVehicleLog">
            <i class="fas fa-fw fa-car"></i>
            <span>Vehicle Log</span>
        </a>
        <div id="collapseVehicleLog" class="collapse {{ $isVehicleLog ? 'show' : '' }}" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('plates*') ? 'active' : '' }}" href="{{ route('plates.index') }}">Vehicle Plate Log</a>
                @can('is-admin')
                <a class="collapse-item {{ Request::is('vehicle-logs*') ? 'active' : '' }}" href="{{ route('vehicle-logs.index') }}">Vehicle Plate Action Log</a>
                @endcan
            </div>
        </div>
    </li>

    @can('is-admin')
    <!-- User Management -->
    <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>User Management</span>
        </a>
    </li>

    <!-- Registered Vehicles -->
    <li class="nav-item {{ Request::is('registered_vehicles*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('registered_vehicles.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Registered Vehicle</span>
        </a>
    </li>
    @endcan
    <!-- Reports -->
    <li class="nav-item {{ Request::is('reports*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('reports.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Reports</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggle Button -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
