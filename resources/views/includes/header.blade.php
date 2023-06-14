<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_bulat_laskar.png') }}" alt="Logo" width="40" height="40" class="d-inline-block">
            {{ config('app.name', 'Laravel') }}
        </a>
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
            <div class="d-flex justify-content-evenly">
                
                    <li class="nav-item d-flex justify-content-evenly">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register_members.index') }}">{{ __('Register') }}</a>
                        @endif
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                    </li>
              
                
            </div>
                
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        {{-- <span class="position-absolute top-1 start-90 translate-middle p-1 bg-danger border border-light rounded-circle"> </span> --}}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('users.show', Auth::user()->user_id) }}"><i class="fa-solid fa-user"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i> 
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
</nav>