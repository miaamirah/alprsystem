@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 font-weight-bold">Edit Plate: {{ $plate->plate_text }}</h4>

    {{-- Show validation errors if any --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('plates.update', $plate->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Plate Number</label>
            <input type="text" class="form-control" value="{{ $plate->plate_text }}" disabled>
        </div>

        <div class="form-group">
            <label>Entry Time</label>
            <input type="text" class="form-control" value="{{ $plate->entry_time }}" disabled>
        </div>

        <div class="form-group">
            <label>Exit Time</label>
            <input type="text" class="form-control" value="{{ $plate->exit_time ?? '-' }}" disabled>
        </div>

        <div class="form-group">
            <label for="flagged">Flag Vehicle?</label>
            <select name="flagged" id="flagged" class="form-control">
                <option value="1" {{ $plate->flagged ? 'selected' : '' }}>YES</option>
                <option value="0" {{ !$plate->flagged ? 'selected' : '' }}>NO</option>
            </select>
        </div>

        <div class="form-group">
            <label for="reason">Reason</label>
            <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Enter reason if flagged" required>{{ $plate->reason }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('plates.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
    </form>
</div>
@endsection
