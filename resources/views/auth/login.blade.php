<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlateTrack</title>

    <!-- Fonts & SB Admin CSS -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    
</head>

<body style="background: url('{{ asset('img/traffic.jpg') }}') no-repeat center center fixed; background-size: cover;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card border-0 shadow-lg my-5" style="border-radius: 15px; height: 600px; box-shadow: 0 8px 24px rgba(8, 79, 160, 0.52)">
                <div class="card-body p-0 h-100">
                    <div class="row h-100 g-0">

                        <!-- Left: Logo -->
                        <div class="col-6 d-flex align-items-center justify-content-center" style="background-color: #e0e0e0; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                            <img src="{{ asset('img/uniten.png') }}" alt="UNITEN Logo" style="max-width: 220px;">
                        </div>

                        <!-- Right: Login Form -->
                        <div class="col-6 d-flex align-items-center justify-content-center" style="background-color: white; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
                            <div class="p-5 w-100">

                                <div class="text-center mb-4">
                                    <h2 class="fw-bold mb-0" style="color:rgb(3, 62, 129);">Welcome to PlateTrack!</h2>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email -->
                                    <div class="form-group mb-3">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." required style="border: 1.5px solid rgba(3, 62, 129, 0.58);">
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group mb-3">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required style="border: 1.5px solid rgba(3, 62, 129, 0.58);">
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="remember"style="border: 1.5px solid rgba(3, 62, 129, 0.58);">
                                            <label class="custom-control-label" for="remember" style="color:rgb(3, 62, 129);">Remember Me</label>
                                        </div>
                                    </div>

                                    <!-- Login Button -->
                                    <button type="submit" class="btn btn-block" style="background-color:rgb(3, 62, 129); color:white; font-weight:600;">
                                        Login
                                    </button>

                                    <!-- Forgot Password -->
                                    <div class="text-center mt-3">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                </form>

                            </div>
                        </div> <!-- end right col -->
                    </div> <!-- end row -->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
