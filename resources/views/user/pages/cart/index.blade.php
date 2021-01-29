@extends('user.templates.default')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>
<div class="row mb-2">
    <div class="col-md-12">
        <h5 data-aos="fade-left" data-aos-delay="100">Keranjang</h5>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                @forelse ($carts as $cart)
                <div class="row pt-3 pb-3 align-items-center " style="color: #747272; border-bottom: 1px solid #aeaeae;"  >
                    <div class="col-md-2">
                        <img src="assets/images/images.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-md-3">
                        <p><b>Barang</b></p>
                        <p>{{ $cart->product->name }}</p>
                        <p>Rp. {{ number_format($cart->product->price) }}</p>
                        <!-- <p class="mt-n3" style="font-size:.9rem">Total : 1</p> -->
                    </div>

                    <div class="col-md-3">
                        <button style="width: 40px;height: 40px;" class="btn btn-outline-secondary">+</button>
                        <span style="width: 40px; height: 40px; margin: 0 10px;">{{ $cart->product_total }}</span>
                        <button style="width: 40px;height: 40px;" class="btn btn-outline-secondary">-</button>
                    </div>

                    <div class="col-md-3">
                        <p><b></b></p>
                        <p>Jumlah : {{ $cart->product_total }}</p>
                        <p>Total : Rp. {{ number_format($cart->product_total * $cart->product->price) }}</p>
                    </div>

                    <div class="col-md-1">
                        <form action="{{ route('cart.destroy', $cart->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"> <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="alert alert-danger text-center mt-2">
                    Kosong!
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @if ($carts->isEmpty())
    @else
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 font-weight-bold">
                        Total Produk
                    </div>
                    <div class="col-lg-6">
                        {{ $carts->count() }}
                    </div>
                </div>
                <div class="row mt-3 mb-5">
                    <div class="col-lg-6 font-weight-bold">
                        Total Bayar
                    </div>
                    <div class="col-lg-6">
                        Rp.{{ number_format($carts->sum('price_total')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('checkout', $cart->id) }}" class="btn btn-sm btn-block btn-primary">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection