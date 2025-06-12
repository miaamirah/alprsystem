<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PlateTrack</title>


    <!-- Fonts & Icons -->
    <link href="https://fonts.bunny.net/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Bootstrap & Vite -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background-color: rgb(3, 62, 129);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .dropdown-toggle {
            color: #ffffff !important;
            font-weight: 600;
        }

        .navbar-custom .nav-link:hover {
            text-decoration: underline;
        }

        .dropdown-menu {
            border-radius: 0.5rem;
        }

        .navbar-brand i {
            margin-right: 6px;
        }

        main {
            padding-top: 30px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm" style="background-color: #ffffff; height: 70px;">
            <div class="container position-relative">

                <!-- Left: PlateTrack Branding -->
                <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}" style="color: rgb(3, 62, 129); font-size: 20px;">
                    <i class="fas fa-car me-2"></i> PlateTrack
                </a>

                <!-- Center: UNITEN Logo -->
                <div class="position-absolute top-50 start-50 translate-middle d-none d-md-block">
                    <img src="{{ asset('img/uniten.png') }}" alt="UNITEN Logo" style="height: 45px;">
                </div>

                <!-- Right: Auth Links -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('login') }}" style="color: rgb(3, 62, 129);">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle fw-semibold" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: rgb(3, 62, 129);">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </nav>


        <main class="container">
            @yield('content')
        </main>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
