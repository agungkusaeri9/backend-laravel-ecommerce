@extends('user.templates.default')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <!-- Shopping Cart Section Begin -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Gambar</th>
                                <th class="p-name text-center">Nama</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart)
                                <tr>
                                    <td class="cart-pic first-row">
                                        @foreach ($cart->product->gallery->where('is_default', 1)->take(1) as $active)
                                            <img src="{{ $active->photo() }}" style="height: 80px" />
                                        @endforeach
                                    </td>
                                    <td class="cart-title first-row text-center">
                                        <h5>{{ $cart->product->name }}</h5>
                                    </td>
                                    <td>Rp. {{ number_format($cart->product->price) }}</td>
                                    <td class="text-center">{{ $cart->amount }}</td>
                                    <td class="p-price first-row">
                                        Rp. {{ number_format($cart->price) }}
                                    </td>
                                    <td>
                                        {{ $cart->notes }}
                                    </td>
                                    <td class="delete-item text-center">
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah yakin ingin menghapus item ini dari keranjang?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Keranjang Kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-5">
                <h4 class="mb-4">
                    Informasi Pembeli:
                </h4>
                <div class="user-checkout">
                    <form method="post" id="formInformation">
                        @csrf
                        <input type="number" id="inp_sub_total" value="{{ $carts->sum('price') }}" class="d-none">
                        <input type="hidden" id="inp_payment" name="payment" class="d-none">
                        <input type="hidden" id="inp_total_biaya" name="transaction_total">
                        <input type="hidden" id="inp_ongkir" name="shipping_cost">
                        <input type="hidden" class="form-control" id="emailAddress" aria-describedby="emailHelp"
                            placeholder="Masukan Email" value="{{ auth()->user()->email }}" name="email">
                        <div class="form-group">
                            <label for="namaLengkap">Nama lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" aria-describedby="namaHelp"
                                placeholder="Masukan Nama" value="{{ auth()->user()->name }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="namaLengkap">Nomor HP</label>
                            <input type="text" class="form-control" id="noHP" aria-describedby="noHPHelp"
                                placeholder="Masukan No. HP" value="{{ auth()->user()->phone_number }}"
                                name="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="cityprovince_destination">Provinsi Tujuan</label>
                            <select name="province_destination" id="province_destination" class="form-control">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_id }}">{{ $province->province_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city_destination">Kota Tujuan</label>
                            <select name="city_destination" id="city_destination" class="form-control">
                                <option value="">-- Pilih Kota --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamatLengkap">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamatLengkap" rows="3" name="address">{{ auth()->user()->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="payment">Metode Pembayaran</label>
                            <select name="payment" id="payment" class="form-control">
                                <option value="">-- Pilih Pembayaran --</option>
                                @foreach ($payments as $payment)
                                    <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="courier">Jasa Pengiriman</label>
                            <select name="courier" id="courier" class="form-control">
                                <option value="">-- Pilih Kurir --</option>
                                @foreach ($couriers as $courier)
                                    <option value="{{ $courier->code }}">{{ $courier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 offset-2">
                <h4 class="mb-4">
                    Detail:
                </h4>
                <div class="proceed-checkout">
                    <ul>
                        <li class="subtotal mt-3">Subtotal <span
                                id="sub_total">{{ number_format($carts->sum('price')) }}</span></li>
                        <li class="subtotal mt-3">Ongkos Kirim <span id="ongkir"></span></li>
                        <li class="subtotal mt-3">Total Biaya <span id="total_biaya"></span></li>
                        <li class="subtotal mt-3">Pembayaran <span id="pembayaran"></span></li>
                        <li class="subtotal mt-3">Nomor <span id="nomor"></span></li>
                        <li class="subtotal mt-3">Nama Penerima <span id="desc"></span></li>
                    </ul>
                    <button href="{{ route('checkout') }}" class="btn-dark w-100 proceed-btn checkout">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Shopping Cart Section End -->
@endsection
@push('afterScripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function() {
            $('#province_destination').on('change', function() {
                let provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '/province/' + provinceId + '/city',
                        type: 'GET',
                        dateType: 'JSON',
                        success: function(data) {
                            $('select[name="city_destination"]').empty();
                            $('select[name="city_destination"]').append(
                                '<option>--Pilih Kota--</option>')
                            $.each(data, function(key, value) {
                                $('select[name="city_destination"]').append(new Option(
                                    value, key));
                            });
                        }
                    })
                } else {
                    $('select[name="city_destination"]').empty();
                }
            })

            $('#courier').on('change', function() {
                $('#inp_ongkir').val('');
                $('#inp_total_biaya').val('');
                $('#ongkir').html('');
                $('#total_biaya').html('');
                $.ajax({
                    url: '/cekongkir',
                    type: "POST",
                    data: $("#formInformation").serialize(),
                    dateType: 'JSON',
                    success: function(data) {
                        let ongkir = data[0]['costs'][1]['cost'][0]['value'];
                        let str_ongkir = numeral(ongkir).format('0,0[.]00');
                        let inp_sub_total = {{ $carts->sum('price') }};
                        $('#inp_ongkir').val(ongkir);
                        let total_bayar = ongkir + inp_sub_total;
                        $('#inp_total_biaya').val(total_bayar);
                        $('#ongkir').html(str_ongkir);
                        $('#total_biaya').html(numeral(total_bayar).format('0,0[.]00'));
                    },
                    error: function(err) {
                        alert('Jasa Pengiriman Tidak Didukung');
                    }
                })
            })

            $('#payment').on('change', function() {
                let paymentId = $(this).val();
                $.ajax({
                    url: '/get-payments/' + paymentId,
                    type: "GET",
                    dateType: 'JSON',
                    success: function(data) {
                        $('#pembayaran').html(data['name']);
                        $('#nomor').html(data['number']);
                        $('#desc').html(data['desc']);
                        $('#inp_payment').val(data['id']);
                    }
                })
            })

            $('.checkout').on('click', function(e) {
                e.preventDefault();
                let href = $(this).attr('href');
                $('#formInformation').attr('action', href);
                $('#formInformation').submit();
            })
        })
    </script>
@endpush
