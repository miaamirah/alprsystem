@extends('layouts.admin')

@section('content')
<div class="min-vh-100 d-flex flex-column justify-content-between">
<div class="container-fluid">
    <!-- Breadcrumbs  -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vehicle Action Log</li>
            </ol>
        </nav>
     <!-- Top Bar: Title , Search  -->
    <div class="row align-items-center mb-4">
        <!-- Search -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('plates.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search plate number..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit" style="background-color:rgb(3, 62, 129);">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Title-->
        <div class="col-md-6 text-center">
            <h4 class="font-weight-bold text-dark mb-0">Vehicle Action Log</h4>
        </div>

        <!-- Empty space to balance layout -->
        <div class="col-md-3"></div>
    </div>


        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


    <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
            <table class="table table-bordered text-center table-responsive" style="font-size: 13px; width: 100%;">
            <thead style="background-color:rgb(3, 62, 129);color: white; text-align:center;">
                <tr>
                    <th style="vertical-align: middle;">License Plate</th>
                    <th style="vertical-align: middle;">Action</th>
                    <th style="vertical-align: middle;">Message</th>
                    <th style="vertical-align: middle;">User ID</th>
                    <th style="vertical-align: middle;">Name</th>
                    <th style="vertical-align: middle;">Time Updated</th>
                    <th style="vertical-align: middle;">Delete</th>
                </tr>
            </thead>

        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->plate?->plate_text ?? '-' }}</td>
                    <!--Upper Case First (ucfirst)-->
                    <td>{{ ucfirst($log->action) }}</td>
                    <td>{{ $log->message ?? '-' }}</td>
                    <td>{{ $log->user->id ?? '-' }}</td>
                    <td>{{ $log->user->name ?? 'Unknown' }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>
                    
                <td>
                <div class="d-flex justify-content-center" style="gap: 0.1rem;">
                    <a href="{{ route('vehicle-logs.show', $log->id) }}" class="btn btn-info btn-sm">View</a>

                    <form action="{{ route('vehicle-logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Delete this log?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
                </td>



                </tr>
            @empty
                <tr><td colspan="5">No logs available.</td></tr>
            @endforelse
        </tbody>
        </table>
</div>
@endsection
