@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 font-weight-bold">Vehicle Action Logs</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    
    <table class="table table-bordered text-center">
        <thead class="bg-dark text-white">
            <tr>
                <th>License Plate</th>
                <th>Action</th>
                <th>Message</th>
                <th>Time Updated</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->plate?->plate_text ?? '-' }}</td>
                    <!--Upper Case First (ucfirst)-->
                    <td>{{ ucfirst($log->action) }}</td>
                    <td>{{ $log->message ?? '-' }}</td>
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
