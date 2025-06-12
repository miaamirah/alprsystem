@extends('layouts.admin')

@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('registered_vehicles.index') }}">Registered Vehicles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>

<div class="container-fluid">
    <!-- Gradient Background Wrapper -->
        <div class="card shadow-lg border-0">
                    <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
                <div class="card-header text-white d-flex align-items-center" style="background-color:rgb(3, 62, 129);">
                <i class="fas fa-edit fa-lg me-2"></i>
                <h5 class="mb-0">Edit Vehicle</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('registered_vehicles.update', $registered_vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control" value="{{ $registered_vehicle->owner_name }}" style="color:#000000; border: 1px solid #949495;" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">Student ID</label>
                        <input type="text" name="student_id" class="form-control" value="{{ $registered_vehicle->student_id }}" style="color:#000000; border: 1px solid #949495;" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">Plate Number</label>
                        <input type="text" name="plate_text" class="form-control" value="{{ $registered_vehicle->plate_text }}" style="color:#000000; border: 1px solid #949495;" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">Vehicle Type</label>
                        <input type="text" name="vehicle_type" class="form-control" value="{{ $registered_vehicle->vehicle_type }}" style="color:#000000; border: 1px solid #949495;" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">Brand</label>
                        <input type="text" name="brand" class="form-control" value="{{ $registered_vehicle->brand }}" style="color:#000000; border: 1px solid #949495;" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">Color</label>
                        <input type="text" name="color" class="form-control" value="{{ $registered_vehicle->color }}" style="color:#000000; border: 1px solid #949495;" required>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('registered_vehicles.index') }}" class="btn btn-secondary px-2">
                            <i class="fas fa-arrow-left me-3"></i> Back to List
                        </a>
                        <button type="submit" class="btn px-4;"style="background-color:rgb(3, 62, 129);color:white;">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
