@extends('layouts.admin')

@section('content')
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
            <table class="table table-bordered table-striped table-hover text-center align-middle" style="border-collapse: collapse;">
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
