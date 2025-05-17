@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="font-weight-bold text-dark mb-0">Vehicle Action Logs</h4>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
        <table class="table table-bordered text-center" style="width: 98%; font-size: 14px; white-space: nowrap;">
        <thead style="background-color:rgb(3, 62, 129);color: white; text-align: center;">
            <tr>
                <th>License Plate</th>
                <th>Action</th>
                <th>Message</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Time Updated</th>
                <th>Delete</th>
            </tr>
        </thead>
    </div>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->plate?->plate_text ?? '-' }}</td>
                    <!--Upper Case First (ucfirst)-->
                    <td>{{ ucfirst($log->action) }}</td>
                    <td>{{ $log->message ?? '-' }}</td>
                    <td>{{ $log->user->id ?? '-' }}</td>
                    <td>{{ $log->user->name ?? 'Unknown' }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>
                    <td>
                        <form action="{{ route('vehicle-logs.destroy', $log->id) }}" method="POST"
                            onsubmit="return confirm('Delete this log?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No logs available.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
