@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Plate Log</li>
        </ol>
    </nav>

    <!-- Top Bar: Search , Title , Filter >
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <-- Search (Left) >
        <form method="GET" action="{{ route('plates.index') }}">
            <div class="input-group" style="width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Search plate number.." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" style="background-color:rgb(3, 62, 129);">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form-->

        <!-- Title -->
        <h4 class="font-weight-bold text-dark text-center mb-0 flex-grow-1">Vehicle Plate Log</h4>

        <!-- Filter  >
        <form method="GET" action="{{ route('plates.index') }}">
            <div class="input-group" style="max-width: 320px;">
                <select name="flag" class="form-select border-0 shadow-sm"
                    style="background-color:rgb(255, 255, 255); color:rgb(97, 107, 118); border-top-left-radius: 0.375rem; border-bottom-left-radius: 0.375rem;">
                    <option value="">All</option>
                    <option value="yes" {{ request('flag') == 'yes' ? 'selected' : '' }}>Flagged</option>
                    <option value="no" {{ request('flag') == 'no' ? 'selected' : '' }}>Not Flagged</option>
                </select>
                 <select name="period" class="form-select border-0 shadow-sm ms-2" style="background-color:rgb(255, 255, 255); color:rgb(97, 107, 118);">
                    <option value="">All Time</option>
                    <option value="yesterday" {{ request('period') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                    <option value="7days" {{ request('period') == '7days' ? 'selected' : '' }}>Last Week</option>
                    <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>This Year</option>
                </select>
                <button class="btn btn-primary" type="submit"
                    style="background-color: rgb(3, 62, 129); border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                    Apply
                </button>
            </div>
        </form>
    </div-->

    <div class="card border-0 p-3"
        style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
    
    <!-- Table -->
    <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center align-middle" style="border-collapse: collapse;">
            <thead class="text-white" style="background-color:rgb(3, 62, 129);">
                <tr style="height: 60px;">
                    <th>Entry Time</th>
                    <th>Exit Time</th>
                    <th>License Plate</th>
                    <th>Time in UNITEN</th>
                    <th>Flag</th>
                    <th>Registered</th>
                    <th style="min-width: 170px;">Actions</th>
                </tr>
            </thead>
            <tbody style="background-color: white;">
                @forelse ($plates as $plate)
                    <tr style="color: #000;">
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
                        <td>
                            @if ($plate->registeredVehicle)
                            <i class="fas fa-check-circle text-success"></i>
                            @else
                            <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center" style="gap:0.4rem;">
                                <a href="{{ route('plates.show', $plate->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('plates.edit', $plate->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                @php $user = Auth::user(); @endphp
                                @if($user->role === 'admin')
                                    <form action="{{ route('plates.destroy', $plate->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this log?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="color:#000;">No plates found.</td></tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
