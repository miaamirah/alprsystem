@extends('layouts.admin')

@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Report</li>
    </ol>
</nav>

<div class="container-fluid">

    <!-- Header Section -->
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

    <!-- Table Card -->
    <div class="card border-0 p-3" style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center align-middle" style="border-collapse: collapse;">
                    <thead style="background-color:rgb(3, 62, 129); color:white;">
                        <tr style="height: 60px;">
                            <th style="border:1px solid #c4c4c4;">ID</th>
                            <th style="border:1px solid #c4c4c4;">Start</th>
                            <th style="border:1px solid #c4c4c4;">End</th>
                            <th style="border:1px solid #c4c4c4;">Total (Range)</th>
                            <th style="border:1px solid #c4c4c4;">Flagged (Range)</th>
                            <th style="border:1px solid #c4c4c4;">Created</th>
                            <th style="border:1px solid #c4c4c4;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->id }}</td>
                                <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->start_date }}</td>
                                <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->end_date }}</td>
                                <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->total_vehicles_range }}</td>
                                <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->flagged_vehicles_range }}</td>
                                <td style="border:1px solid #dee2e6; color:#212529;">{{ $report->created_at->format('Y-m-d H:i') }}</td>
                                <td style="border:1px solid #dee2e6; color:#212529;">
                                    <div class="d-flex justify-content-center" style="gap: 0.4rem;">
                                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Delete this report?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-muted">No reports found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
