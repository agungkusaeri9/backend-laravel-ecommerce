<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container" id="navbar-flex">
        <a class="navbar-brand" href="{{ route('home') }}" id="logo" >Olshop</a>
        <form class="form-inline ml-2" style="width:90%;" id="navbar-search">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width:100%;">
            <span style="height:100%; background-color: white; width: 30px; margin-left: -40px;">
                
            </span>
        </form>
       
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-3"></ul>
    
    
            <ul class="navbar-nav mr-auto ml-4"></ul>
    
            <ul class="navbar-nav mr-right ml-4">
                @guest
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('login') }}">Login</a>       
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>       
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Str::ucfirst(auth()->user()->name) }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('transaction.index') }}" class="dropdown-item">Riwayat Transaksi</a>
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
                @endguest
            </ul>
    
        </div>
    
    </div>
</nav>