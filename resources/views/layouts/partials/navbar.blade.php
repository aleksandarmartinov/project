<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a href="{{ route('welcome') }}" class="navbar-brand m-3">Oglasi</a>
    <ul class="navbar-nav ms-auto">
        <form action="{{ route('search') }}" method="GET" class="form-inline my-2 my-lg-0">
            <div class="d-flex">
                <input type="search" name ="query" class="form-control mr-sm-2 flex-grow-1" placeholder="Search">
                <button class="btn btn-outline-dark ml-sm-2 my-2 my-sm-0" type="submit">Search</button>
            </div>
        </form>
        @if (Route::has('login'))
            @auth
                <li class="nav-item">              
                    <a class="nav-link" href="{{ url('/home') }}" class="nav-link">Home</a>
                </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </li>
            @endif
            @endauth
        @endif
    </ul>
</nav>