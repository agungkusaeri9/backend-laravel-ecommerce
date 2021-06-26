@extends('user.templates.default')
@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($product_banner as $banner)
        <div class="single-hero-items set-bg" data-setbg="{{ $banner->gallery[0]->photo() }}" style="background-size:100%">
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
<section id="section-title">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h2 class="text-center section-title">Pilih Kategori</h2>
            </div>
        </div>
        <div class="row text-center">
            @foreach ($categories as $category)
            <div class="col-4 col-md-2">
                <a href="">
                    <div class="category-item mb-2">
                        <img src="{{ $category->icon() }}" alt="" style="height:180px" class="w-100">
                        <h5 class="text-uppercase mt-2">{{ $category->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- akhir kategori --}}
<section id="section-title">
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
                            <img src="{{ $terlaris->gallery[0]->photo() }}" alt="" />
                            <ul>
                                <li class="w-icon active">
                                    <a href="#"><i class="icon_bag_alt"></i></a>
                                </li>
                                <li class="quick-view"><a href="{{ route('product.show', $terlaris->slug) }}">+ Quick View</a></li>
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
                <h2 class="text-center section-title">Terbaru</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($products_latest as $product)
                <div class="col-md-4">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ $product->gallery[0]->photo() }}" alt="" />
                            <ul>
                                <li class="w-icon active">
                                    <a href="#"><i class="icon_bag_alt"></i></a>
                                </li>
                                <li class="quick-view"><a href="{{ route('product.show', $product->slug) }}">+ Quick View</a></li>
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
    </div>
</section>

@endsection
@push('afterStyles')
<style>
    .section-title{
        font-family: 'Righteous', cursive;
        margin-top: 80px;
        margin-bottom: 40px;
        text-transform: uppercase;
    }
</style>
@endpush