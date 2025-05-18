@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Log</li>
        </ol>
    </nav>

    <!-- Top Bar: Search , Title , Filter -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <!-- Search (Left) -->
        <form method="GET" action="{{ route('plates.index') }}">
            <div class="input-group" style="width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Search plate number.." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" style="background-color:rgb(3, 62, 129);">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Title -->
        <h4 class="font-weight-bold text-dark text-center mb-0 flex-grow-1">Vehicle Log</h4>

        <!-- Filter  -->
        <form method="GET" action="{{ route('plates.index') }}">
            <div class="input-group" style="max-width: 320px;">
                <select name="flag" class="form-select border-0 shadow-sm"
                    style="background-color:rgb(255, 255, 255); color:rgb(97, 107, 118); border-top-left-radius: 0.375rem; border-bottom-left-radius: 0.375rem;">
                    <option value="">All</option>
                    <option value="yes" {{ request('flag') == 'yes' ? 'selected' : '' }}>Flagged</option>
                    <option value="no" {{ request('flag') == 'no' ? 'selected' : '' }}>Not Flagged</option>
                </select>
                <button class="btn btn-primary" type="submit"
                    style="background-color: rgb(3, 62, 129); border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                    Apply
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
        <table class="table table-bordered align-middle text-center" style="font-size: 14px;">
            <thead class="text-white" style="background-color:rgb(3, 62, 129);">
                <tr style="height: 60px;">
                    <th>Entry Time</th>
                    <th>Exit Time</th>
                    <th>License Plate</th>
                    <th>Time in UNITEN</th>
                    <th>Flag</th>
                    <th>Reason</th>
                    <th style="min-width: 170px;">Actions</th>
                </tr>
            </thead>
            <tbody style="background-color: white;">
                @forelse ($plates as $plate)
                    <tr>
                        <td>{{ $plate->entry_time }}</td>
                        <td>{{ $plate->exit_time ?? '-' }}</td>
                        <td>{{ $plate->plate_text }}</td>
                        <td>
                            @if ($plate->entry_time && $plate->exit_time)
                                @php
                                    $diff = \Carbon\Carbon::parse($plate->entry_time)->diff(\Carbon\Carbon::parse($plate->exit_time));
                                @endphp
                                {{ $diff->h }} hr{{ $diff->h != 1 ? 's' : '' }}
                                {{ $diff->i }} min{{ $diff->i != 1 ? 's' : '' }}
                                {{ $diff->s }} s{{ $diff->s != 1 ? 's' : '' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $plate->flagged ? 'Yes' : 'No' }}</td>
                        <td>{{ $plate->reason ?? '-' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="{{ route('plates.show', $plate->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('plates.edit', $plate->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('plates.destroy', $plate->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this log?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No plates found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
