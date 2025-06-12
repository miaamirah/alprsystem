@extends('layouts.admin')

@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('registered_vehicles.index') }}">Registered Vehicles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Details</li>
    </ol>
</nav>

<!-- Make full-width like the first card -->
<div class="container-fluid">
    <div class="card shadow-lg border-0 mb-5" style="border-radius: 15px;">
        <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
            <div class="card-header text-white" style="background-color:rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="mb-0"><i class="fas fa-id-card-alt me-2"></i> Vehicle Details</h5>
            </div>

            <div class="card-body px-4 py-4" style="color: #000;">
                <table class="table table-bordered align-middle mb-4" style="border-collapse: collapse;">
                    <tr>
                        <th class="bg-light text-dark" style="width: 30%; font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-user text-purple me-2"></i> Owner Name
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $registered_vehicle->owner_name }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-id-badge text-info me-2"></i> Student ID
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $registered_vehicle->student_id }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-car-side text-danger me-2"></i> Plate Number
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $registered_vehicle->plate_text }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-car text-warning me-2"></i> Vehicle Type
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $registered_vehicle->vehicle_type }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-industry text-primary me-2"></i> Brand
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $registered_vehicle->brand }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-palette text-info me-2"></i> Color
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $registered_vehicle->color }}</td>
                    </tr>
                </table>

                <div class="text-start">
                    <a href="{{ route('registered_vehicles.index') }}" class="btn btn-secondary px-3">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
