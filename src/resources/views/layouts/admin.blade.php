<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', '') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/{{ config('app.font_awesome_kit_id') }}.js"></script>

</head>
<body id="page-body">
    <div id="app">
        @if(Auth::guard('admin')->check())
        <div class="left-navbar" id="left-navbar">
            <nav class="left-nav">
                <div>
                    <div class="left-nav-brand">
                        <i class="fas fa-arrow-right left-nav-toggle" id="left-nav-toggle"></i>
                    </div>
                    
                    <div class="left-nav-list">
                        <a href="#" class="left-nav-link active">
                            <i class="fas fa-home left-nav-icon"></i>
                            <span class="left-nav-name">{{ __('Dashboard') }}</span>
                        </a>
                        <a href="#" class="left-nav-link">
                            <i class="fas fa-users left-nav-icon"></i>
                            <span class="left-nav-name">{{ __('Users') }}</span>
                        </a>
                        <a href="#" class="left-nav-link">
                            <i class="fas fa-user-shield left-nav-icon"></i>
                            <span class="left-nav-name">{{ __('Admins') }}</span>
                        </a>
                        <a href="#" class="left-nav-link">
                            <i class="fas fa-cog left-nav-icon"></i>
                            <span class="left-nav-name">{{ __('Settings') }}</span>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="left-nav-profile">
                        <img src="{{ asset('images/default_admin.png') }}" class="left-nav-profile-img" id="left-nav-profile-img" title="{{ Auth::guard('admin')->user()->name }}">
                        <span class="left-nav-admin-name d-none" id="left-nav-admin-name">{{ Auth::guard('admin')->user()->name }}</span>
                    </div>
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="left-nav-link">
                        <i class="fas fa-sign-out-alt left-nav-icon"></i>
                        <span class="left-nav-name">{{ __('Logout') }}</span>
                    </a>
                </div>
            </nav>
        </div>
        @endif
    
    
        <div class="right-section" id="right-section">
            @if (Auth::guard('admin')->check())
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow fixed-top top-navbar-shrinker-base" id="top-navbar">
            @else
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow fixed-top" id="top-navbar">
            @endif
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    {{ config('app.name', 'Laravel') }} | Admin
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-bell nav-icon"></i><sup><span class="badge badge-pill badge-danger">1</span></sup>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('admin')->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    {{ __('Change Password') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>

        </div>
        
        <footer class="footer mt-auto text-muted">
            Copyright © {{ \Carbon\Carbon::now()->format('Y') }} {{ config('app.name') }}.
        </footer>
    </div>
</body>
</html>
