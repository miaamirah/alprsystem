@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs  -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('vehicle-logs.index') }}">Vehicle Action Log</a></li>
                <li class="breadcrumb-item active" aria-current="page">View</li>
            </ol>
        </nav>
    <h4 class="font-weight-bold text-dark mb-4">Vehicle Log Detail</h4>

    <div class="card shadow p-4 mb-5 bg-white rounded">
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">License Plate</div>
            <div class="col-md-9">{{ $log->plate->plate_text ?? '-' }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Action</div>
            <div class="col-md-9">{{ ucfirst($log->action) }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Message</div>
            <div class="col-md-9">{{ $log->message ?? '-' }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">User ID</div>
            <div class="col-md-9">{{ $log->user->id ?? '-' }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Name</div>
            <div class="col-md-9">{{ $log->user->name ?? 'Unknown' }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Time Updated</div>
            <div class="col-md-9">{{ $log->created_at->format('d M Y, h:i A') }}</div>
        </div>

        <div class="text-end">
            <a href="{{ route('vehicle-logs.index') }}" class="btn btn-secondary">Back to Logs</a>
        </div>
    </div>

</div>
@endsection
