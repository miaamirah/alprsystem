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

    /* Parent: flex the two controls across the row */
    .dataTables_wrapper .dataTables_length {
        float: left !important;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right !important;
        justify-content: flex-end;
    }

    /* Optionally, adjust width of filter input */
    .dataTables_wrapper .dataTables_filter input[type="search"] {
        max-width: 350px;
    }

    /* Style DataTables Pagination */
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1.3rem;
        margin-bottom: 0.7rem;
        display: flex;
        justify-content: flex-end;  /* move right, or use center for centered */
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

    /* Optional: Remove outline for buttons on click */
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

    /* Show asc/desc icons for active sort */
    table.dataTable thead th.sorting_asc {
        background-image: url('https://cdn.datatables.net/1.10.25/images/sort_asc.png');
    }
    table.dataTable thead th.sorting_desc {
        background-image: url('https://cdn.datatables.net/1.10.25/images/sort_desc.png');
    }

    /* Make sure the background doesn't get covered */
    table.dataTable thead th {
        position: relative;
        /* Remove background-color if needed to test */
        /* background-color: #175ad3 !important; */
        /* Or add some right padding so arrows are not squashed */
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

<div class="container-fluid">

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Plate Log</li>
        </ol>
    </nav>

    <!-- Top Bar: Search , Title , Filter >
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <-- Search (Left) >
        <form method="GET" action="{{ route('plates.index') }}">
            <div class="input-group" style="width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Search plate number.." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" style="background-color:rgb(3, 62, 129);">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form-->

        <!-- Title -->
        <h4 class="font-weight-bold text-dark text-center mb-0 flex-grow-1">Vehicle Plate Log</h4>

        <!-- Filter  >
        <form method="GET" action="{{ route('plates.index') }}">
            <div class="input-group" style="max-width: 320px;">
                <select name="flag" class="form-select border-0 shadow-sm"
                    style="background-color:rgb(255, 255, 255); color:rgb(97, 107, 118); border-top-left-radius: 0.375rem; border-bottom-left-radius: 0.375rem;">
                    <option value="">All</option>
                    <option value="yes" {{ request('flag') == 'yes' ? 'selected' : '' }}>Flagged</option>
                    <option value="no" {{ request('flag') == 'no' ? 'selected' : '' }}>Not Flagged</option>
                </select>
                 <select name="period" class="form-select border-0 shadow-sm ms-2" style="background-color:rgb(255, 255, 255); color:rgb(97, 107, 118);">
                    <option value="">All Time</option>
                    <option value="yesterday" {{ request('period') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                    <option value="7days" {{ request('period') == '7days' ? 'selected' : '' }}>Last Week</option>
                    <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>This Year</option>
                </select>
                <button class="btn btn-primary" type="submit"
                    style="background-color: rgb(3, 62, 129); border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                    Apply
                </button>
            </div>
        </form>
    </div-->

    <div class="card border-0 p-3"
        style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
    
    <!-- Table -->
    <div class="table-responsive">
            <table id="platesTable" class="table table-bordered table-striped table-hover text-center align-middle" style="border-collapse: collapse;">
            <thead class="text-white" style="background-color:rgb(3, 62, 129);">
                <tr style="height: 60px;">
                    <th>Entry Time</th>
                    <th>Exit Time</th>
                    <th>License Plate</th>
                    <th>Time in UNITEN</th>
                    <th>Flag</th>
                    <th>Registered</th>
                    <th style="min-width: 170px;">Actions</th>
                </tr>
            </thead>
            <tbody style="background-color: white;">
                @forelse ($plates as $plate)
                    <tr style="color: #000;">
                        <td>{{ $plate->entry_time }}</td>
                        <td>{{ $plate->exit_time ?? '-' }}</td>
                        <td>{{ $plate->plate_text }}</td>
                        <td>
                            @if ($plate->entry_time && $plate->exit_time)
                                @php
                                    $diff = \Carbon\Carbon::parse($plate->entry_time)->diff(\Carbon\Carbon::parse($plate->exit_time));
                                @endphp
                                {{ $diff->h }} hr{{ $diff->h != 1 ? 's' : '' }}
                                {{ $diff->i }} min{{ $diff->i != 1 ? 's' : '' }}
                                {{ $diff->s }} s{{ $diff->s != 1 ? 's' : '' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $plate->flagged ? 'Yes' : 'No' }}</td>
                        <td>
                            <span style="display: none;">{{ $plate->registeredVehicle ? 'yes' : 'no' }}</span>
                            @if ($plate->registeredVehicle)
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center" style="gap:0.4rem;">
                                <a href="{{ route('plates.show', $plate->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('plates.edit', $plate->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                @php $user = Auth::user(); @endphp
                                @if($user->role === 'admin')
                                    <form action="{{ route('plates.destroy', $plate->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this log?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="color:#000;">No plates found.</td></tr>
                @endforelse
            </tbody>

        </table>
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
            $('#platesTable').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 }, // Disable sorting for last column (Actions)
                    { searchable: true,  targets: 2 }, // License Plate column (assuming Entry Time is 0, License Plate is is 2)
                    { searchable: false, targets: [0, 1, 3, 4, 5, 6] } 
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search Plate Number"
                }
            });

            // Move DataTables search bar to be wider and more centered if needed
            $('.dataTables_filter input[type="search"]').css({
                'width': '100%',
                'max-width': '700px'
            });
        });
    </script>
@endpush