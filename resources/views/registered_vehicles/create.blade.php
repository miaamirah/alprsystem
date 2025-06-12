@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('registered_vehicles.index') }}">Registered Vehicles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
        <div class="card-header text-white d-flex align-items-center" style="background-color:rgb(3, 62, 129);">
            <i class="fas fa-plus-circle fa-lg me-2" style="margin-right: 14px;"></i>
            <h5 class="mb-0">Register New Vehicle</h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('registered_vehicles.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="fw-semibold" style="color:#000000;margin-right: 14px;"> 👤 Owner Name</label>
                    <input type="text" name="owner_name" class="form-control" placeholder="e.g. John Doe" value="{{ old('owner_name') }}" style="color:#000000; border: 1px solid #949495;" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold" style="color:#000000;"><i class="fas fa-id-badge me-2 text-info"  style="margin-right: 14px;"></i>Student ID</label>
                    <input type="text" name="student_id" class="form-control" placeholder="e.g. C123456" value="{{ old('student_id') }}" style="color:#000000; border: 1px solid #949495;" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold" style="color:#000000;"><i class="fas fa-car-side me-2 text-danger" style="margin-right: 14px;"></i>Plate Number</label>
                    <input type="text" name="plate_text" class="form-control" placeholder="e.g. ABC1234" value="{{ old('plate_text') }}" style="color:#000000; border: 1px solid #949495;" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold" style="color:#000000;"><i class="fas fa-car me-2 text-warning"  style="margin-right: 14px;"></i>Vehicle Type</label>
                    <input type="text" name="vehicle_type" class="form-control"  value="{{ old('vehicle_type') }}" style="color:#000000; border: 1px solid #949495;" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold" style="color:#000000;"><i class="fas fa-industry me-2" style="margin-right: 14px;"></i>Brand</label>
                    <input type="text" name="brand" class="form-control" placeholder="e.g. Toyota" value="{{ old('brand') }}" style="color:#000000; border: 1px solid #949495;" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold" style="color:#000000;"><i class="fas fa-palette me-2 text-primary" style="margin-right: 14px;"></i>Color</label>
                    <input type="text" name="color" class="form-control" placeholder="e.g. Red" value="{{ old('color') }}" style="color:#000000; border: 1px solid #949495;" required>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('registered_vehicles.index') }}" class="btn btn-secondary px-2">
                        <i class="fas fa-arrow-left me-3"></i> Back to List
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-plus me-1"></i> Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
