@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 font-weight-bold text-dark">Plate Details</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>License Plate</th>
                    <td>{{ $plate->plate_text }}</td>
                </tr>
                <tr>
                    <th>Entry Time</th>
                    <td>{{ $plate->entry_time ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Exit Time</th>
                    <td>{{ $plate->exit_time ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Flagged</th>
                    <td>{{ $plate->flagged ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Reason</th>
                    <td>{{ $plate->reason ?? '-' }}</td>
                </tr>
            </table>

            <a href="{{ route('plates.index') }}" class="btn btn-secondary mt-3">Back</a>
            <a href="{{ route('plates.edit', $plate->id) }}" class="btn btn-primary mt-3">Edit</a>
        </div>
    </div>
</div>
@endsection
