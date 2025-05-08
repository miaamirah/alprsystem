<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlateTrack</title>

    <!-- Fonts & SB Admin CSS -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body style="background: url('{{ asset('img/traffic.jpg') }}') no-repeat center center fixed; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5" style="height: 600px;">
                    <div class="card-body p-0 h-100">
                        <div class="row h-100 g-0">

                            <!-- Left: Logo -->
                            <div class="col-6 d-flex align-items-center justify-content-center" style="background-color: #e0e0e0;">
                                <img src="{{ asset('img/uniten.png') }}" alt="UNITEN Logo" style="max-width: 250px;">
                            </div>

                            <!-- Right: Login Form -->
                            <div class="col-6 d-flex align-items-center justify-content-center" style="background-color: white;">
                                <div class="p-5 w-100">
                                    <div class="text-center mb-4">
                                        <b><h1 class="h4 text-gray-900">Welcome to PlateTrack!</b> </h1>
                                    </div>

                                    <!-- Connected to Laravel Auth -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." required autofocus>
                                        </div>

                                        <div class="form-group mb-3">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                                <label class="custom-control-label" for="remember">Remember Me</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                        <div class="text-center mt-3">
                                            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
