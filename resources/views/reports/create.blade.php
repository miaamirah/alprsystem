@extends('layouts.admin')

@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Report</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card border-0 p-3"
      style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
        <div class="card-header text-white d-flex align-items-center" style="background-color:rgb(3, 62, 129);">
            <i class="fas fa-file-alt fa-lg me-2" style="margin-right: 12px;"></i>
            <h5 class="mb-0">Generate New Report</h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger mb-3 small">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reports.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="start_date" class="fw-semibold text-dark">
                        📅 Start Date
                    </label>
                    <input type="date" name="start_date" class="form-control"
                           style="border: 1px solid #b0bec5;" required>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="fw-semibold text-dark">
                        📅 End Date
                    </label>
                    <input type="date" name="end_date" class="form-control"
                           style="border: 1px solid #b0bec5;" required>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary px-6">
                        <i class="fas fa-arrow-left me-2"style="margin-right: 5px;"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success px-4"style="background-color:rgb(3, 62, 129);color:white;">
                        <i class="fas fa-file-download me-2"></i> Generate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
