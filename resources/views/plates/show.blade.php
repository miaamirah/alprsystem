@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plates.index') }}">Vehicle Log</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>

    <!-- Card Container -->
    <div class="card shadow-lg border-0 mb-5" style="border-radius: 15px;">
        <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">

            <!-- Card Header -->
            <div class="card-header text-white" style="background-color:rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="mb-0"><i class="fas fa-id-card-alt me-2"></i> Vehicle Details</h5>
            </div>

            <!-- Card Body -->
            <div class="card-body px-4 py-4" style="color: #000;">
                <table class="table table-bordered align-middle mb-4" style="border-collapse: collapse;">
                    <tr>
                        <th class="bg-light text-dark" style="width: 30%; font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-car text-primary me-2" style="margin-right: 10px;"></i> License Plate
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $plate->plate_text }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-clock text-success me-2" style="margin-right: 10px;"></i> Entry Time
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $plate->entry_time ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-door-open text-warning me-2" style="margin-right: 10px;"></i> Exit Time
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $plate->exit_time ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-flag text-danger me-2" style="margin-right: 10px;"></i> Flagged
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">
                            {!! $plate->flagged ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-user-check text-success me-2" style="margin-right: 10px;"></i> Registered
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">
                            @if ($plate->registeredVehicle)
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-comment-alt text-info me-2" style="margin-right: 10px;"></i> Reason
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $plate->reason ?? '-' }}</td>
                    </tr>
                    @if ($plate->logs->last())
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-user-edit text-secondary me-2" style="margin-right: 10px;"></i> Last Edited By
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $plate->logs->last()->user->name ?? 'Unknown' }}</td>
                    </tr>
                    @endif
                    

                </table>

                <div class="text-start mt-4">
                    <a href="{{ route('plates.index') }}" class="btn btn-secondary px-3">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
