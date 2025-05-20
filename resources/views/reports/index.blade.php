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
    <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="w-100 text-center">
                <h4 class="font-weight-bold text-dark mb-0">Generated Report</h4>
            </div>
        <a href="{{ route('reports.create') }}"
            style="background:rgb(3, 62, 129);color:white;padding:8px 20px;border:none;border-radius:5px;text-decoration:none;font-size:15px;font-weight:600;white-space:nowrap;
                    box-shadow:0 2px 4px rgba(0,0,0,0.08);">New Report
            </a>
  
    </div>  

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow p-3">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead style="background-color:rgb(3, 62, 129);color: white; text-align:center;">
                    <tr>
                        <th>ID</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Total (Range)</th>
                        <th>Flagged (Range)</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->start_date }}</td>
                            <td>{{ $report->end_date }}</td>
                            <td>{{ $report->total_vehicles_range }}</td>
                            <td>{{ $report->flagged_vehicles_range }}</td>
                            <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                 <div class="d-flex justify-content-center" style="gap: 0.1rem;">
                                <a href="{{ route('reports.show', $report->id) }}" class="btn btn-sm btn-info">View</a>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Delete this log?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">No reports found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
