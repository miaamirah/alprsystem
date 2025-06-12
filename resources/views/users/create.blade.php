@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create User</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
            <div class="card-header text-white d-flex align-items-center" style="background-color:rgb(3, 62, 129);">
                <h5 class="mb-0"><i class="fas fa-user-plus me-2" style="margin-right: 12px;"></i> Create New User</h5>
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

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">
                            <i class="fas fa-user text-primary me-2" style="margin-right: 10px;"></i> Name
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Jane Doe"
                            style="color:#000000; border: 1px solid #949495;" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">
                            <i class="fas fa-envelope text-info me-2" style="margin-right: 10px;"></i> Email
                        </label>
                        <input type="email" name="email" class="form-control" placeholder="e.g. jane@gmail.com"
                            style="color:#000000; border: 1px solid #949495;" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">
                            <i class="fas fa-user-tag text-success me-2" style="margin-right: 10px;"></i> Role
                        </label>
                        <select name="role" class="form-control"
                            style="color:#000000; background-color:#fff; border: 1px solid #949495;" required>
                            <option value="">-- Select Role --</option>
                            <option value="admin">Admin</option>
                            <option value="security">Security</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold" style="color:#000000;">
                            <i class="fas fa-lock text-danger me-2" style="margin-right: 10px;"></i> Password
                        </label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Minimum 8 characters"
                                style="color:#000000; border: 1px solid #949495;" required>
                            <span class="input-group-text" style="cursor:pointer;" onclick="togglePassword()">
                                <i id="eyeIcon" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary px-3">
                            <i class="fas fa-arrow-left me-2" style="margin-right: 6px;"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-plus me-1"></i> Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Password toggle script -->
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
