
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
                            <a class="dropdown-item" href="{{ route('allIssues')}}"><i class="bi bi-list text-info"></i> All Issues</a>
                            <a class="dropdown-item" href="{{ route('myissues') }}"><i class="bi bi-tag text-info"></i> My Issues</a>
                          </div>
                        </ul>
                      </li>
                      <li>
                        <ul class="nav-item dropdown" id="dropdownTeams">
                          <a class="nav-link dropdown-toggle" href='#' role="button" data-bs-toggle="dropdown" aria-expanded="false">Teams</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownIssues">
                            <a class="dropdown-item" href="{{ route('createTeam' )}}"><i class="bi bi-plus-circle text-info"></i> New Team</a>
                            <a class="dropdown-item" href="{{ route('allTeams')}}"><i class="bi bi-person-lines-fill text-info"></i> All Teams</a>
                          </div>
                        </ul>
                      </li>
                      <li>
                        <ul class="nav-item dropdown" id="dropdownUsers">
                          <a class="nav-link dropdown-toggle" href='#' role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownUsers">
                            <a class="dropdown-item" href="{{ route('createTeam' )}}"><i class="bi bi-person-fill-add text-info"></i> New User</a>
                            <a class="dropdown-item" href="{{ route('allTeams')}}"><i class="bi bi-person-rolodex text-info"></i> All Users</a>
                          </div>
                        </ul>
                      </li>
 
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

