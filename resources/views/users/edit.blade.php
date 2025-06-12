@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
            <div class="card-header text-white d-flex align-items-center" style="background-color:rgb(3, 62, 129);">
                <h5 class="mb-0"><i class="fas fa-user-edit me-2" style="margin-right: 12px;"></i> Edit User</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger small">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="fw-semibold text-dark">
                            <i class="fas fa-user text-primary me-2" style="margin-right: 10px;"></i> Name
                        </label>
                        <input type="text" name="name" value="{{ ucfirst($user->name) }}" class="form-control"
                            style="color:#000; border: 1px solid #949495;" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold text-dark">
                            <i class="fas fa-envelope text-info me-2" style="margin-right: 10px;"></i> Email
                        </label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                            style="color:#000; border: 1px solid #949495;" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold text-dark">
                            <i class="fas fa-user-tag text-success me-2" style="margin-right: 10px;"></i> Role
                        </label>
                        <select name="role" class="form-control"
                            style="color:#000; background-color: #fff; border: 1px solid #949495;" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="security" {{ $user->role == 'security' ? 'selected' : '' }}>Security</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold text-dark">
                            <i class="fas fa-lock text-danger me-2" style="margin-right: 10px;"></i> New Password
                        </label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Leave blank to keep current password"
                                style="color:#000; border: 1px solid #949495;">
                            <span class="input-group-text" style="cursor:pointer;" onclick="togglePassword()">
                                <i id="eyeIcon" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary px-3">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Password Visibility -->
<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
@endsection
