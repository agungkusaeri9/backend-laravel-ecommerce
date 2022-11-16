@extends('user.templates.default')
@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($product_banner as $banner)
        <div class="single-hero-items set-bg" data-setbg="{{ $banner->img() }}" style="background-size:100%">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <span>{{ $banner->category->name }}</span>
                        <h1>{{ $banner->name }}</h1>
                        <a href="{{ route('product.show', $banner->slug) }}" class="primary-btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- kategori --}}
<section class="mb-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h6 class="text-center mb-3 section-title">Kategori</h6>
            </div>
        </div>
        <div class="row text-center">
            @foreach ($categories as $category)
            <div class="col-3 col-lg-2 col-md-2">
                <a href="{{ route('product.category', $category->slug) }}">
                    <div class="category-item mb-2">
                        <img src="{{ $category->icon() }}" alt="{{ $category->name }}" id="category-img">
                        <h5 class="text-uppercase mt-2 category-title">{{ $category->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- akhir kategori --}}
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center section-title">Terlaris</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product-slider owl-carousel">
                    @foreach ($product_terlaris as $terlaris)
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ $terlaris->img() }}" alt="" />
                            <ul>
                                <li class="w-icon active" onclick="addToCart()">
                                    <a href="javascript:void(0)"><i class="icon_bag_alt"></i></a>
                                    <form action="{{ route('cart.store') }}" method="post" class="d-none" id="form-add-to-cart">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $terlaris->id }}">
                                        <input type="hidden" name="price" value="{{ $terlaris->price }}">
                                    </form>
                                </li>
                                <li class="quick-view"><a href="{{ route('product.show', $terlaris->slug) }}">+ Detail</a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{ $terlaris->category->name }}</div>
                            <a href="#">
                                <h5>{{ $terlaris->name }}</h5>
                            </a>
                            <div class="product-price">
                            Rp. {{ number_format($terlaris->price) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- terlaris -->
<!-- terlaris -->

<section id="section-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center section-title text-left">Terbaru</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($products_latest as $product)
                <div class="col-6 col-md-3">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ $product->img() }}" alt="" />
                            <ul>
                                <li class="w-icon active" onclick="addToCart()">
                                    <a href="javascript:void(0)"><i class="icon_bag_alt"></i></a>
                                    <form action="{{ route('cart.store') }}" method="post" class="d-none" id="form-add-to-cart">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $terlaris->id }}">
                                        <input type="hidden" name="price" value="{{ $terlaris->price }}">
                                    </form>
                                </li>
                                <li class="quick-view"><a href="{{ route('product.show', $product->slug) }}">+ Detail</a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{ $product->category->name }}</div>
                            <a href="#">
                                <h5>{{ $product->name }}</h5>
                            </a>
                            <div class="product-price">
                               Rp. {{ number_format($product->price) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-3">
            <div class="col-12">
                {{ $products_latest->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</section>

<section id="section-title pembayaran" class="mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-white text-muted">Pembayaran</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($payments as $payment)
                <div class="col-3">
                    <div style="height:150px;width:cover;background-image: url('{{ $payment->icon() }}');background-size:100%;opacity:.9;background-repeat:no-repeat">
                </div>

                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
@push('afterStyles')
<link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
@endpush
@push('afterScripts')
<!-- Toastr -->
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<script>
    function addToCart(){
        $('#form-add-to-cart').submit();
    }
</script>
@include('user.templates.partials.alert')
@endpush