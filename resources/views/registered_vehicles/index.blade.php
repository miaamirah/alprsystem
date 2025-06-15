@extends('layouts.admin')

@section('content')
<style>
    /* DataTables pill-shaped search bar with teal hover */
    .dataTables_filter label {
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }

    .dataTables_filter input[type="search"] {
        border-radius: 999px;
        border: 1.5px solid #ccc;
        padding: 0.32rem 1.1rem;
        font-size: 1rem;
        color: #666;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #fff;
        box-shadow: none;
        outline: none;
        margin-left: 0;
        width: 100%;
        max-width: 550px;
        height: 2.5rem;
    }

    .dataTables_filter input[type="search"]:hover,
    .dataTables_filter input[type="search"]:focus {
        border-color:rgb(3, 62, 129);
        box-shadow: 0 2px 8px rgb(3, 62, 129);
    }

    /* Make DataTables top controls appear side by side */
    .dataTables_wrapper .dataTables_length, 
    .dataTables_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        margin-bottom: 0; /* Remove extra spacing */
    }

    .dataTables_wrapper .dataTables_length {
        float: left !important;
    }
    .dataTables_wrapper .dataTables_filter {
        float: right !important;
        justify-content: flex-end;
    }
    .dataTables_wrapper .dataTables_filter input[type="search"] {
        max-width: 350px;
    }

    /* Style DataTables Pagination */
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1.3rem;
        margin-bottom: 0.7rem;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        font-size: 1rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        border: none !important;
        background: #f5f6fa !important;
        color: #333 !important;
        padding: 6px 16px !important;
        margin: 0 3px !important;
        font-weight: 600;
        transition: background 0.18s, color 0.18s;
        box-shadow: none !important;
        outline: none !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:focus {
        background: #41acbc !important;
        color: #fff !important;
        border: none !important;
        font-weight: bold;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #175ad3 !important;
        color: #fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .ellipsis {
        background: none !important;
        color: #888 !important;
        padding: 6px 10px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
        outline: none !important;
    }

    /* Show DataTables sorting icons on dark/colored headers */
    table.dataTable thead th.sorting,
    table.dataTable thead th.sorting_asc,
    table.dataTable thead th.sorting_desc {
        background-image: url('https://cdn.datatables.net/1.10.25/images/sort_both.png');
        background-repeat: no-repeat;
        background-position: center right 14px;
        background-size: 18px 18px;
        cursor: pointer;
    }
    table.dataTable thead th.sorting_asc {
        background-image: url('https://cdn.datatables.net/1.10.25/images/sort_asc.png');
    }
    table.dataTable thead th.sorting_desc {
        background-image: url('https://cdn.datatables.net/1.10.25/images/sort_desc.png');
    }
    table.dataTable thead th {
        position: relative;
        padding-right: 28px !important;
    }
    /* Hide sorting arrows for the Actions column */
    table.dataTable thead th:last-child,
    table.dataTable thead th:last-child.sorting,
    table.dataTable thead th:last-child.sorting_asc,
    table.dataTable thead th:last-child.sorting_desc {
        background-image: none !important;
        cursor: default !important;
    }
</style>

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Registered Vehicles</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="w-100 text-center">
            <h2 class="fw-bold mb-0" style="color:rgb(3, 62, 129);"> <i class="fas fa-car me-2"style="margin-right: 14px;"></i>Registered Vehicles</h2></div>
        <a href="{{ route('registered_vehicles.create') }}" class="btn" style="background-color:rgb(3, 62, 129); color:white; padding:8px 20px;border:none;border-radius:5px;text-decoration:none;font-size:15px;font-weight:600;white-space:nowrap;">
            <i class="fas fa-user-plus me-1"></i> Register New Vehicle
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <div class="card border-0 p-3"
        style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
        <div class="table-responsive">
            <table id="registeredVehiclesTable" class="table table-bordered table-striped table-hover text-center align-middle" style="border-collapse: collapse;">
                <thead style="background-color:rgb(3, 62, 129); color:white;">
                    <tr>
                        <th style="border:1px solid #c4c4c4;">No</th>
                        <th style="border:1px solid #c4c4c4;">Plate</th>
                        <th style="border:1px solid #c4c4c4;">Owner</th>
                        <th style="border:1px solid #c4c4c4;">Student ID</th>
                        <th style="border:1px solid #c4c4c4;">Type</th>
                        <th style="border:1px solid #c4c4c4;">Brand</th>
                        <th style="border:1px solid #c4c4c4;">Color</th>
                        <th style="border:1px solid #c4c4c4;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                        <tr>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $vehicle->id }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $vehicle->plate_text }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $vehicle->owner_name }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $vehicle->student_id }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $vehicle->vehicle_type }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $vehicle->brand }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $vehicle->color }}</td>
                            <td>
                                <div class="d-flex justify-content-center" style="gap: 0.4rem;">
                                    <a href="{{ route('registered_vehicles.show', $vehicle->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('registered_vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('registered_vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-muted">No registered vehicles found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#registeredVehiclesTable').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 } // Disable sorting for Action column
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search Registered Vehicles"
                }
            });

            // Make search bar wider and visually balanced
            $('.dataTables_filter input[type="search"]').css({
                'width': '100%',
                'max-width': '700px'
            });
        });
    </script>
@endpush
