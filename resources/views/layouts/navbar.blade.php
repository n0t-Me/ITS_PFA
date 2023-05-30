<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main class="py-4">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav me-auto">
                      <li>
                        <ul class="nav-item dropdown" id="dropdownIssues">
                          <a class="nav-link dropdown-toggle" href='#' role="button" data-bs-toggle="dropdown" aria-expanded="false">Issues</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownIssues">
                            <a class="dropdown-item" href="{{ route('createIssue' )}}"><i class="bi bi-plus-circle text-info"></i> New Issue</a>
                            <a class="dropdown-item" href="{{ route('myissues') }}"><i class="bi bi-tag text-info"></i> My Issues</a>
                            @if(Auth::user()->role !== "guest")
                            <a class="dropdown-item" href="{{ route('allIssues')}}"><i class="bi bi-flag text-info"></i> Reported Issues</a>
                            @endif
                            @if(Auth::user()->role === "member" ||  Auth::user()->role === "team-admin")
                            <a class="dropdown-item" href="{{ route('assignedIssues') }}"><i class="bi bi-person-workspace text-info"></i> Assigned Issues</a>
                            @endif
                          </div>
                        </ul>
                      </li>
                      @if(Auth::user()->role === "admin")
                      <li>
                        <ul class="nav-item dropdown" id="dropdownTeams">
                          <a class="nav-link dropdown-toggle" href='#' role="button" data-bs-toggle="dropdown" aria-expanded="false">Teams</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownIssues">
                            <a class="dropdown-item" href="{{ route('createTeam' )}}"><i class="bi bi-plus-circle text-info"></i> New Team</a>
                            <a class="dropdown-item" href="{{ route('allTeams')}}"><i class="bi bi-person-lines-fill text-info"></i> All Teams</a>
                          </div>
                        </ul>
                      </li>
                      @endif
                      @if(Auth::user()->role === "admin" || Auth::user()->role === "team-admin")
                      <li>
                        <ul class="nav-item dropdown" id="dropdownUsers">
                          <a class="nav-link dropdown-toggle" href='#' role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownUsers">
                            @if(Auth::user()->role === "admin")
                            <a class="dropdown-item" href="{{ route('createUser' )}}"><i class="bi bi-person-fill-add text-info"></i> New User</a>
                            <a class="dropdown-item" href="{{ route('allUsers')}}"><i class="bi bi-person-rolodex text-info"></i> All Users</a>
                            @elseif(Auth::user()->role === "team-admin")
                            <a class="dropdown-item" href="{{ route('allUsers')}}"><i class="bi bi-person-rolodex text-info"></i> Team Members</a>
                            @endif
                          </div>
                        </ul>
                      </li>
                      @endif
                    </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person-gear text-info"></i> Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-power text-danger"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        </main>
</div>
</body>
</html>


