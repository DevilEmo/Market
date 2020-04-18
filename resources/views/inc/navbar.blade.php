    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top shadow-sm" style="text-shadow:gray">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/images/resources_images/logo_real.png" alt="brnd_logo" height="50px" width="50px" class="rounded-circle align-middle">
                San Luis @if (Auth::user())
                @if(Auth::user()->account_type === "admin")- Admin @else - Cashier @endif
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="home">Post</a>
                    </li> --}}
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        {{-- <li class="nav-item {{ Request::is('login') ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item {{ Request::is('register') ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li> --}}
                    @else
                    @if(Auth::user()->account_type === "admin")
                        <li class="nav-item {{ Request::is('admin/create_stall_owner') ? 'active' : ''}}">
                            <a class="nav-link" href="/admin/create_stall_owner">CREATE STALL OWNER</a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/stall_owner_list') ? 'active' : ''}}">
                            <a class="nav-link" href="/admin/stall_owner_list">STALL OWNERS</a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/parking_records') ? 'active' : ''}}">
                            <a class="nav-link" href="/admin/parking_records">TICKETING</a>
                        </li>
                    @else
                        <li class="nav-item {{ Request::is('cashier/rent_payment') ? 'active' : ''}}">
                            <a class="nav-link" href="/cashier/rent_payment">STALL OWNERS </a>
                        </li>
                        <li class="nav-item {{ Request::is('cashier/parking_payment') ? 'active' : ''}}">
                            <a class="nav-link" href="/cashier/parking_payment">TICKETING</a>
                        </li>
                    @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="/setting/{{Auth::user()->id}}" class="dropdown-item">Account Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li>
                            <img src="/images/profile_images/{{ Auth::user()->profile_image }}" alt="{{ Auth::user()->profile_image }}" height="35px" width="35px" class="rounded-circle align-middle">
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>