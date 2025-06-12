@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-6">
        <div class="card border-0 shadow" style="border-radius: 15px;">
            <div class="card-header text-white" style="background-color: rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="mb-0"><i class="fas fa-lock me-2"></i> Confirm Password</h5>
            </div>

            <div class="card-body px-4 py-4">
                <p class="mb-4">Please confirm your password before continuing.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" class="form-control rounded @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn text-white fw-bold" style="background-color: rgb(3, 62, 129);">
                            <i class="fas fa-check-circle me-1"></i> Confirm
                        </button>

                        @if (Route::has('password.request'))
                            <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
