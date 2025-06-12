@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-8">
        <div class="card border-0 shadow" style="border-radius: 15px;">
            <div class="card-header text-white" style="background-color: rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h4 class="mb-0"><i class="fas fa-unlock-alt me-2"></i> Reset Password</h4>
            </div>

            <div class="card-body px-4 py-4">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input id="email" type="email" class="form-control rounded @error('email') is-invalid @enderror"
                               name="email" value="{{ $email ?? old('email') }}" required autofocus>

                        @error('email')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">New Password</label>
                        <input id="password" type="password" class="form-control rounded @error('password') is-invalid @enderror"
                               name="password" required>

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-semibold">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control rounded" name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn text-white fw-bold" style="background-color: rgb(3, 62, 129);">
                            <i class="fas fa-sync-alt me-1"></i> Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
