<footer class="footer-section mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="footer-left">
                    <div class="footer-logo text-light" style="font-family: 'Righteous', cursive; font-size:40px">
                        {{ $store->name }}
                    </div>
                    <ul>
                        <li>{{ $store->address }}</li>
                        <li>{{ $store->phone_number }}</li>
                        <li>{{ $store->email }}</li>
                    </ul>
                    <div class="footer-social">
                        <a href="{{ $store->facebook_link }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $store->instagram_link }}" target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="footer-widget">
                    <h5>Information</h5>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Serivius</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-widget">
                    <h5>My Account</h5>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Shopping Cart</a></li>
                        <li><a href="#">Shop</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-reserved">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        Copyright &copy;
                        {{ \Carbon\Carbon::now()->format('Y') }}
                        All rights reserved | Putri Store
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>