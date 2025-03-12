<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        #navbar-wrapper {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        #navbar {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
        }

        #navbar-brand {
            color: #3498db;
            font-size: 1.5rem;
        }

        #navbar-links {
            display: flex;
            gap: 20px;
        }

        #sidebar {
            background-color: #2C3E50;
            color: #ECF0F1;
            position: fixed;
            height: 100%;
            width: 25%; /* Set width to 25% for screens like laptops and mobiles using computer site */
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1;
            padding-top: 20px;
            margin-top: 60px;
            display: block;
        }

        #sidebar ul.nav.flex-column li.nav-item {
            border-bottom: 1px solid #34495E;
        }

        #sidebar ul.nav.flex-column li.nav-item a.active {
            background-color: #3498DB;
            color: #ECF0F1;
        }

        #main-content {
            transition: margin-left 0.3s;
            padding: 20px;
            margin-left: 25%; /* Adjusted margin for open sidebar on the side */
        }

        @media (max-width: 767px), (min-width: 768px) {
            #sidebar {
                display: none;
               z-index: 0;
              width: 20%;
            }

            #main-content {
                margin-left: 0; /* For larger screens, content should not be affected by the sidebar */
            }
        }
    </style>

    <!-- Your existing CSS -->
    <style>
        /* Add your existing styles here */
    </style>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <div id="navbar-wrapper">
            <div id="navbar">
                <div id="navbar-brand">
                    <!-- No Hamburger Icon for larger screens -->
                </div>
                <div id="navbar-links">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Sidebar (aside) -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <!-- Your existing sidebar links here -->
                    <!-- Dashboard Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <!-- Student Component Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            Students
                        </a>
                    </li>

                    <!-- Add more links for other components as needed -->
                </ul>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main id="main-content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
