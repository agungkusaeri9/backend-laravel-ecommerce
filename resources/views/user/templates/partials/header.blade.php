<header class="header-section pb-0">
    <div class="header-top">
        <div class="container">
            <div class="ht-left mt-1">
                <div class="mail-service pt-2">
                    <i class=" fa fa-envelope"></i> {{ $store->email }}
                </div>
                <div class="phone-service pt-2">
                    <i class=" fa fa-phone"></i> {{ $store->phone_number }}
                </div>
            </div>
            <div class="float-right mt-1">
                <ul class="list-inline">
                    <li class="list-inline-item mr-0">
                        <a href="" class="btn btn-link text-decoration-none text-dark">Home</a>
                    </li>
                    <li class="list-inline-item mr-0">
                        <a href="" class="btn btn-link text-decoration-none text-dark">Contact</a>
                    </li>
                    <li class="list-inline-item mr-0">
                        <a href="" class="btn btn-link text-decoration-none text-dark">About</a>
                    </li>
                </ul>
            </div>
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
                <div class="col-lg-10 text-right col-md-3">
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
