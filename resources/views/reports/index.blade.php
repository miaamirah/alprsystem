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

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Report</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="w-100 text-center">
            <h2 class="fw-bold mb-0" style="color:rgb(3, 62, 129);">
                <i class="fas fa-chart-bar me-2" style="margin-right: 14px;"></i>Generated Report
            </h2>
        </div>
        <a href="{{ route('reports.create') }}" class="btn" style="background-color:rgb(3, 62, 129); color:white; padding:8px 20px; border:none; border-radius:5px; text-decoration:none; font-size:15px; font-weight:600; white-space:nowrap;">
            <i class="fas fa-plus-circle me-1"></i> New Report
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 p-3"
        style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
        <div class="table-responsive">
            <table id="reportsTable" class="table table-bordered table-hover text-center align-middle" style="border-collapse: collapse;">
                <thead style="background-color:rgb(3, 62, 129); color:white;">
                    <tr>
                        <th style="border:1px solid #c4c4c4;">No</th>
                        <th style="border:1px solid #c4c4c4;">Start</th>
                        <th style="border:1px solid #c4c4c4;">End</th>
                        <th style="border:1px solid #c4c4c4;">Total (Range)</th>
                        <th style="border:1px solid #c4c4c4;">Flagged (Range)</th>
                         @if(auth()->user()->role === 'admin')
                            <th style="border:1px solid #c4c4c4;">Generated By</th>
                         @endif
                        <th style="border:1px solid #c4c4c4;">Created</th>
                        <th style="border:1px solid #c4c4c4;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $loop->iteration }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->start_date }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->end_date }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->total_vehicles_range }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->flagged_vehicles_range }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->user->name ?? 'Unknown' }}</td>
                            @endif
                            <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->created_at->format('Y-m-d H:i') }}</td>
                            <td style="border:1px solid #dee2e6; color:#212529;">
                                <div class="d-flex justify-content-center" style="gap: 0.4rem;">
                                    <a href="{{ route('reports.show', $report->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Delete this report?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-muted">No reports found.</td></tr>
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
            $('#reportsTable').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 } // Disable sorting for Action column
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search Report"
                }
            });

            $('.dataTables_filter input[type="search"]').css({
                'width': '100%',
                'max-width': '700px'
            });
        });
    </script>
@endpush