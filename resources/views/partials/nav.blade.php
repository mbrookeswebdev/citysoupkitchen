<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item active">
                        <a class="nav-link" href="/shopping-cart"><i class="fas fa-shopping-cart"></i> Shopping
                            Cart<span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('register') }}"><i
                                    class="far fa-user"></i> {{ __('Register') }}
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> {{ __('Login') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="/shopping-cart"><i class="fas fa-shopping-cart"></i> Shopping
                            Cart<span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Hello {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('display-orders')}}"
                               onclick="event.preventDefault();
                                                     document.getElementById('display-orders').submit();">
                                {{ __('Your Orders') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <form id="display-orders" action="{{ route('display-orders') }}" method="GET"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
