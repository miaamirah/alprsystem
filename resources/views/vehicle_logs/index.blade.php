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
        margin-bottom: 0;
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
    table.dataTable thead th:last-child,
    table.dataTable thead th:last-child.sorting,
    table.dataTable thead th:last-child.sorting_asc,
    table.dataTable thead th:last-child.sorting_desc {
        background-image: none !important;
        cursor: default !important;
    }
</style>

<div class="min-vh-100 d-flex flex-column justify-content-between">
<div class="container-fluid">

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Plate Action Log</li>
        </ol>
    </nav>

    <!-- Top Bar -->
    <div class="row">
        <div class="col-12">
            <h2 class="fw-bold mb-4 text-center" style="color:rgb(3,62,129); font-family: 'Inter', 'Nunito', Arial, sans-serif; font-weight: 600;">Vehicle Plate Action Log</h2>
        </div>
    </div>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="card border-0 p-3" style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
        <div class="table-responsive">
            <table id="vehicleLogsTable" class="table table-bordered table-striped table-hover text-center align-middle" style="border-collapse: collapse;">
                <thead class="text-white" style="background-color:rgb(3, 62, 129);">
                    <tr style="height: 60px;">
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Action</th>
                        <th>License Plate</th>
                        <th>Time Updated</th>
                        <th>Message</th>
                        <th style="min-width: 170px;">Action</th>
                    </tr>
                </thead>
                <tbody style="background-color: white;">
                    @forelse($logs as $log)
                        <tr style="color: #000;">
                            <td>{{ $log->user->id ?? '-' }}</td>
                            <td>{{ $log->user->name ?? 'Unknown' }}</td>
                            <td>{{ ucfirst($log->action) }}</td>
                            <td>{{ $log->plate?->plate_text ?? '-' }}</td>
                            <td>{{ $log->created_at->diffForHumans() }}</td>
                            <td>{{ $log->message ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center" style="gap: 0.4rem;">
                                    <a href="{{ route('vehicle-logs.show', $log->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <form action="{{ route('vehicle-logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Delete this log?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">No logs available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
            $('#vehicleLogsTable').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 } // Disable sorting for Action column
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search"
                }
            });

            $('.dataTables_filter input[type="search"]').css({
                'width': '100%',
                'max-width': '700px'
            });
        });
    </script>
@endpush
