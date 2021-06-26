<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i> {{ $store->email }}
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i> {{ $store->phone_number }}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <h4 style="font-family: 'Righteous', cursive;">Putri Store</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7"></div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="cart-icon">
                            @auth
                            {{ auth()->user()->name }}
                            <a href="{{ route('cart.index') }}">
                                <i class="icon_bag_alt"></i>
                                <span>{{ $cart_count }}</span>
                            </a>
                            @else
                            <a href="{{ route('cart.index') }}">
                                Keranjang Anda
                                <i class="icon_bag_alt"></i>
                                <span>0</span>
                            </a>
                            @endauth &nbsp;
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>