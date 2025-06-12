@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-start" style="min-height: 9vh; padding-top: 7vh;">
    <div class="card border-0 shadow" style=
    "   max-width: 500px;
        width: 100%;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52);">
        <!-- Card Header -->
        <div class="card-header text-white" 
             style="background-color: rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <h5 class="mb-0"><i class="fas fa-unlock me-2"></i> Reset Password</h5>
        </div>

        <!-- Card Body -->
        <div class="card-body px-4 py-6">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input id="email" type="email" 
                           class="form-control rounded @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn text-white fw-bold" 
                            style="background-color: rgb(3, 62, 129);">
                        <i class="fas fa-paper-plane me-1"></i> Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
