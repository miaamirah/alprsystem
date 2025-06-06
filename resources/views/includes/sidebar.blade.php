<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:rgb(3, 62, 129);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PlateTrack</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Vehicle Log -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('plates.index') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Vehicle Log</span>
        </a>
    </li>

    <!-- Nav Item - Vehicle Action Log -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('vehicle-logs.index') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Vehicle Action Log</span>
        </a>
    </li>

    <!-- Nav Item - Reports -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('reports.index') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Reports</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
