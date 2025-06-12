@extends('layouts.admin')

@section('content')
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
    <div class="row align-items-center mb-4">
        <!-- Search -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('vehicle-logs.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search plate number..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit" style="background-color:rgb(3, 62, 129);">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Title -->
        <div class="col-md-5 text-center">
            <h4 class="font-weight-bold text-dark mb-0">Vehicle Plate Action Log</h4>
        </div>

        <!-- Filter -->
        <div class="col-md-3">
            <form method="GET" action="{{ route('vehicle-logs.index') }}" class="d-flex">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <select name="period" class="form-select border-0 shadow-sm me-2" style="max-width: 150px; color: #000;">
                    <option value="">All Time</option>
                    <option value="yesterday" {{ request('period') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                    <option value="7days" {{ request('period') == '7days' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>This Year</option>
                </select>
                <button class="btn btn-primary" type="submit" style="background-color: rgb(3, 62, 129);">
                    Apply
                </button>
            </form>
        </div>
    </div>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="card border-0 p-3" style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center align-middle" style="border-collapse: collapse;">
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
@endsection
