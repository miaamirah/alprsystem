@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 font-weight-bold">Add Vehicle Log</h4>

    <form method="POST" action="{{ route('vehicle-logs.store') }}">
        @csrf

        <div class="form-group">
            <label for="plate_id">Select Plate</label>
            <select name="plate_id" class="form-control" required>
                @foreach($plates as $plate)
                    <option value="{{ $plate->id }}">{{ $plate->plate_text }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="action">Action</label>
            <input type="text" name="action" class="form-control" placeholder="e.g. flagged, updated" required>
        </div>

        <div class="form-group">
            <label for="message">Optional Message</label>
            <textarea name="message" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Log</button>
    </form>
</div>
@endsection
