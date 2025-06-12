@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('vehicle-logs.index') }}">Vehicle Action Log</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>
    <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
    <div class="card shadow-lg border-0 mb-5" style="border-radius: 15px;">
        <div class="card-header text-white" style="background-color:rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <h5 class="mb-0"><i class="fas fa-id-card-alt me-2"></i> Vehicle Log Details</h5>
        </div>

        <div class="card-body px-4 py-4" style="color: #000;">
            <table class="table table-bordered align-middle mb-4" style="border-collapse: collapse;">
                <tr>
                    <th class="bg-light text-dark" style="width: 30%; font-weight:600; border: 1px solid #b0bec5;">
                        <i class="fas fa-id-badge text-secondary me-2" style="margin-right: 10px;"></i> User ID
                    </th>
                    <td style="color:#212529; border: 1px solid #b0bec5;">{{ $log->user->id ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="bg-light text-dark" style="font-weight:600; border: 1px solid #b0bec5;">
                        <i class="fas fa-user text-success me-2" style="margin-right: 10px;"></i> Name
                    </th>
                    <td style="color:#212529; border: 1px solid #b0bec5;">{{ $log->user->name ?? 'Unknown' }}</td>
                </tr>
                <tr>
                    <th class="bg-light text-dark" style="font-weight:600; border: 1px solid #b0bec5;">
                        <i class="fas fa-cogs text-warning me-2" style="margin-right: 10px;"></i> Action
                    </th>
                    <td style="color:#212529; border: 1px solid #b0bec5;">{{ ucfirst($log->action) }}</td>
                </tr>
                <tr>
                    <th class="bg-light text-dark" style="font-weight:600; border: 1px solid #b0bec5;">
                        <i class="fas fa-car text-primary me-2" style="margin-right: 10px;"></i> License Plate
                    </th>
                    <td style="color:#212529; border: 1px solid #b0bec5;">{{ $log->plate->plate_text ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="bg-light text-dark" style="font-weight:600; border: 1px solid #b0bec5;">
                        <i class="fas fa-clock text-danger me-2" style="margin-right: 10px;"></i> Time Updated
                    </th>
                    <td style="color:#212529; border: 1px solid #b0bec5;">{{ $log->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th class="bg-light text-dark" style="font-weight:600; border: 1px solid #b0bec5;">
                        <i class="fas fa-comment-dots text-info me-2" style="margin-right: 10px;"></i> Message
                    </th>
                    <td style="color:#212529; border: 1px solid #b0bec5;">{{ $log->message ?? '-' }}</td>
                </tr>
            </table>


            <div class="text-start mt-4">
                <a href="{{ route('vehicle-logs.index') }}" class="btn btn-secondary px-3">
                    <i class="fas fa-arrow-left me-2"></i> Back to Logs
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
