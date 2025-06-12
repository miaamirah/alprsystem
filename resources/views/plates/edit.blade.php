@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plates.index') }}">Vehicle Log</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <!-- Card Container -->
    <div class="card shadow-lg border-0 mb-5" style="border-radius: 15px;">
        <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">

            <!-- Card Header -->
            <div class="card-header text-white" style="background-color:rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Plate: {{ $plate->plate_text }}</h5>
            </div>

            <!-- Card Body -->
            <div class="card-body px-4 py-4" style="color:#000;">

                <!-- Show validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('plates.update', $plate->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Plate Number -->
                    <div class="mb-3">
                        <label class="fw-semibold text-dark">🪪 Plate Number</label>
                        <input type="text" class="form-control" value="{{ $plate->plate_text }}" disabled style="border: 1px solid #b0bec5; color: #212529;">
                    </div>

                    <!-- Entry Time -->
                    <div class="mb-3">
                        <label class="fw-semibold text-dark">⏱️ Entry Time</label>
                        <input type="text" class="form-control" value="{{ $plate->entry_time }}" disabled style="border: 1px solid #b0bec5; color: #212529;">
                    </div>

                    <!-- Exit Time -->
                    <div class="mb-3">
                        <label class="fw-semibold text-dark">🚪 Exit Time</label>
                        <input type="text" class="form-control" value="{{ $plate->exit_time ?? '-' }}" disabled style="border: 1px solid #b0bec5; color: #212529;">
                    </div>

                    <!-- Flagged Dropdown -->
                    <div class="mb-3">
                        <label class="fw-semibold text-dark" for="flagged">🚩 Flag Vehicle?</label>
                        <select name="flagged" id="flagged" class="form-control" style="border: 1px solid #b0bec5; color: #212529;">
                            <option value="1" {{ $plate->flagged ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$plate->flagged ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Reason -->
                    <div class="mb-4">
                        <label class="fw-semibold text-dark" for="reason">📝 Reason</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Enter reason if flagged" required style="border: 1px solid #b0bec5; color: #212529;">{{ $plate->reason }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('plates.index') }}" class="btn btn-secondary px-3">
                            <i class="fas fa-arrow-left me-2"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-success px-3">
                            <i class="fas fa-save me-2"></i> Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
