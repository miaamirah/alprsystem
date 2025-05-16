@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0">Vehicle Log</h4>

    <!--search vehicle-->
    <form method="GET" action="{{ route('plates.index') }}" class="d-flex">
        <div class="input-group" style="width: 300px;">
            <input type="text" name="search" class="form-control" placeholder="Search plate number.." value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" style="background-color:rgb(3, 62, 129);">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <!--table class="table table-bordered table-striped text-center"-->
        <table class="table table-bordered text-center" style="width: 98%; font-size: 14px; white-space: nowrap;">
            <thead style="background-color:rgb(3, 62, 129);
             color: white; text-align: center;">
                <tr style="height: 60px;">
                    <th style="vertical-align: middle;">Entry time</th>
                    <th style="vertical-align: middle;">Exit time</th>
                    <th style="vertical-align: middle;">License Plate</th>
                    <th style="vertical-align: middle;">Time in UNITEN</th>
                    <th style="vertical-align: middle;">Flag</th>
                    <th style="vertical-align: middle;">Reason</th>
                    <th style="vertical-align: middle;">Edit</th>
                </tr>
            </thead>
            <tbody style="background-color: white;">
                @forelse ($plates as $plate)
                    <tr>
                        <td>{{ $plate->entry_time }}</td>
                        <td>{{ $plate->exit_time ?? '-' }}</td>
                        <td>{{ $plate->plate_text }}</td>

                        <!--Time in UNITEN -->
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


                        <!-- Flag -->
                        <td>{{ $plate->flagged ? 'Yes' : 'No' }}</td>

                        <!-- Reason -->
                        <td>{{ $plate->reason ?? '-' }}</td>

                       <td class="text-center">
                        <!-- View button -->
                        <a href="{{ route('plates.show', $plate->id) }}" class="btn btn-info btn-sm me-2">View</a>

                        <!-- Edit button -->
                        <a href="{{ route('plates.edit', $plate->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>

                        <!-- Delete button -->
                        <form action="{{ route('plates.destroy', $plate->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No plates found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
