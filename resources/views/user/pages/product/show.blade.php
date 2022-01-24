@extends('user.templates.default')
@section('content')
<div class="container">
    @include('user.templates.partials.alert')
</div>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{ route('product.index') }}">Produk</a>
                    <span>{{ $product->name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-pic-zoom">
                            <img class="product-big-img" src="{{ $product->gallery[0]->photo() }}" alt="{{ $product->name }}" />
                        </div>
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                                @foreach ($product->gallery as $gallery)
                                <div class="pt" data-imgbigurl="{{ $gallery->photo() }}">
                                    <img src="{{ $gallery->photo() }}" alt="" class="@if($product->gallery[0]->photo === $gallery->photo) active @endif"/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details">
                            <div class="pd-title">
                                <span>{{ $product->category->name }}</span>
                                <h3>{{ $product->name }}</h3>
                            </div>
                            <div class="pd-desc" style="min-height: 305px">
                                <p>
                                    {!! $product->desc !!}
                                </p>
                                <p class="font-weight-bold">Stok : {{ $product->qty }}</p>
                                <h4>Rp. {{ number_format($product->price) }}</h4>
                            </div>
                            <div class="form">
                                <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <div class="form-group">
                                        <label for="">Jumlah</label>
                                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ 1 ?? old('amount') }}" style="width: 60px;">
                                        @error('amount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="notes" id="notes" cols="30" rows="3" class="form-control @error('notes') is-invalid @enderror" placeholder="Cth. Ukuran L, Warna Merah">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback d-inline">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button class="primary-btn btn pd-cart">Tambah Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-title">Produk Lainnya</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($product_related as $related)
            <div class="col-lg-3 col-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ $related->gallery[0]->photo() }}" alt="" />
                        <ul>
                            <li class="w-icon active">
                                <a href="#"><i class="icon_bag_alt"></i></a>
                            </li>
                            <li class="quick-view"><a href="{{ route('product.show', $related->slug) }}">+ Quick View</a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">{{ $related->category->name }}</div>
                        <a href="#">
                            <h5>{{ $related->name }}</h5>
                        </a>
                        <div class="product-price">
                            Rp. {{ number_format($related->price) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection