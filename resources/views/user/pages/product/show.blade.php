@extends('user.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="text-dark-font-weight-bold">Detail Produk "{{ $product->name }}"</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 mt-2 mb-4">
                        <h5 class="text-dark font-weight-bold">{{ $product->name }}</h5>
                    </div>
                    <div class="col-lg-12">
                        <img src="{{ $product->gallery->first()->photo() }}" alt="{{ $product->name }}" class="img-fluid w-100" style="max-height: 400px">
                    </div>
                    <div class="col-lg-12">
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <h6 class="text-dark font-weight-bold">Deskripsi</h6>
                            </div>
                            <div class="col-lg-12">
                                <p>
                                    {!! $product->desc !!}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="font-weight-bold">
                                    Stok
                                </h6>
                            </div>
                            <div class="col-lg-6">
                                {{ $product->qty }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body"> 
                <div class="row mt-2 mb-2">
                    <div class="col-lg font-weight-bold">Harga</div>
                    <div class="col-lg font-italic">Rp. {{ number_format($product->price) }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('cart.store', $product->slug) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Jumlah</label>
                                <input type="number" name="product_total" value="1" style="width:15%;">
                                @if(session('error'))
                                    <div class="invalid-feedback d-block">
                                        {{session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inf" class="text-dark font-weight-bold">Keterangan</label>
                                <textarea name="inf" id="" class="w-100 form-control" rows="2" placeholder="contoh: ukuran 42"></textarea>
                                @error('inf')
                                <div class="invalid-feedback d-inline">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary btn-block" @if($product->qty < 1) disabled @endif>Add To Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection