@extends('layouts.admin')

@section('content')
        <!-- Breadcrumbs  -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Report</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
<div class="container-fluid">
    <h4 class="mb-4 font-weight-bold text-dark">Generate Report</h4>

    <form action="{{ route('reports.store') }}" method="POST" class="card shadow p-4 bg-white">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Generate</button>
        </div>
    </form>
</div>
@endsection
