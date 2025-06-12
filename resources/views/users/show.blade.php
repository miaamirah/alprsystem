@extends('layouts.admin')

@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Details</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card shadow-lg border-0 mb-5" style="border-radius: 15px;">
        <div style="box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52); border-radius: 15px; background-color: #fff;">
            <div class="card-header text-white" style="background-color:rgb(3, 62, 129); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="mb-0"><i class="fas fa-id-card me-2"></i> User Details</h5>
            </div>

            <div class="card-body px-4 py-4" style="color: #000;">
                <table class="table table-bordered align-middle mb-4" style="border-collapse: collapse;">
                    <tr>
                        <th class="bg-light text-dark" style="width: 30%; font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-user text-purple me-2"></i> Name
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-envelope text-info me-2"></i> Email
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-dark" style="font-weight:600; border:1px solid #b0bec5;">
                            <i class="fas fa-shield-alt text-primary me-2"></i> Role
                        </th>
                        <td style="color:#212529; border:1px solid #b0bec5;">
                            <span class="badge rounded-pill px-3 py-2" style="background-color:rgb(3, 62, 129); color:white; font-size:0.9rem;">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                    </tr>
                </table>

                <div class="text-start">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary px-3">
                        <i class="fas fa-arrow-left me-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
