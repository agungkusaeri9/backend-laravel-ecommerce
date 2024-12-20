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
                        <a href="https://wa.me/{{ $store->phone_number }}?text=Halo {{ $store->name }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                        <a href="{{ $store->facebook_link }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $store->instagram_link }}" target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="footer-widget">
                    <h5>Informasi</h5>
                    <ul>
                        <li><a href="{{ route('product.index') }}">Produk</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                        <li><a href="{{ route('about') }}">Tentang</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-widget">
                    <h5>Akun Saya</h5>
                    <ul>
                        <li><a href="{{ route('account.show') }}">Profil</a></li>
                        <li><a href="{{ route('cart.index') }}">Keranjang</a></li>
                        <li><a href="{{ route('transactions.index') }}">Transaksi</a></li>
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
                        All rights reserved | {{ $store->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
