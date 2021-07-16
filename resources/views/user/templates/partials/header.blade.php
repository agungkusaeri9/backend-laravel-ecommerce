<header class="header-section pb-0">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service pt-2">
                    <i class=" fa fa-envelope"></i> {{ $store->email }}
                </div>
                <div class="phone-service pt-2">
                    <i class=" fa fa-phone"></i> {{ $store->phone_number }}
                </div>
            </div>
            {{-- <div class="ht-right">
                <a href="{{ route('product.index') }}" class="nav-link align-self-center d-inline text-dark font-weight-bold">Product</a>
                <a href="{{ route('contact') }}" class="nav-link align-self-center d-inline text-dark font-weight-bold">Contact Us</a>
                <a href="{{ route('about') }}" class="nav-link align-self-center d-inline text-dark font-weight-bold">About Us</a>
                @auth
                <a href="{{ route('logout') }}" class="nav-link align-self-center d-inline text-dark font-weight-bold" onclick="event.preventDefault(); confirm('Apakah yakin ingin keluar?');
                document.getElementById('logout-form').submit();">Logout</a>
                <form method="post" action="{{ route('logout') }}" class="d-none" id="logout-form">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" class="nav-link align-self-center d-inline text-dark font-weight-bold">Login</a>
                @endauth
            </div> --}}
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <h4 style="font-family: 'Righteous', cursive;">{{ $store->name }}</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <form action="{{ route('products.search') }}" method="get" class=" align-self-center">
                        <div class="form-group">
                            <input type="text" placeholder="Cari Barang Kesukaan Anda" class="form-control search d-block" style="height: 40px;" name="name" value="{{ request('name') ?? '' }}">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="cart-icon">
                            <a href="{{ route('account.show') }}">{{ auth()->user()->name ?? 'Akun Saya' }}</a>
                            <a href="{{ route('cart.index') }}">
                                <i class="icon_bag_alt"></i>
                                <span>{{ $cart_count }}</span>
                            </a> &nbsp;
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
