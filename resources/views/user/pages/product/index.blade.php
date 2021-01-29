@extends('user.templates.default')
@section('content')
<div id="carouselExampleCaptions" class="carousel slide mt-2" data-ride="carousel" style="width: 100%; margin: auto;"> 
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('assets/frontend/images/banner-pubg.png') }}" class="d-block w-100" alt="...">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('assets/frontend/images/banner-pubg.png') }}" class="d-block w-100" alt="...">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('assets/frontend/images/banner-pubg.png') }}" class="d-block w-100" alt="...">
        </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>  
<div class="row mt-2">
    <div class="col-md-12">
        <h5>
            Kategori Produk
        </h5>
    </div>
</div>
<div class="row" id="media" style="text-align: center;">
    <!-- card  -->
    @foreach ($categories as $category)
    <div class="col-md-3">
        <a href="{{ route('product.category', $category->slug) }}">
            <div class="card mb-3" style="border-radius: 10px ; height: 200px;" data-aos="fade-left">
                <img src="{{ asset('assets/frontend/images/banner-pubg.png') }}" class="card-img-top " alt="..." style="max-height: 150px; width: 90%; text-align: center; margin:15px auto 0; border-radius: 5px;" >
                <div class="card-body ">
                    <h5 class="card-title text-dark">{{ $category->name }}</h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    <!--end card  -->
</div>
<div class="row">
    <div class="col-lg-12">
        <h5>Semua Produk</h5>
    </div>
</div>
<div class="row mb-4 cardHover">
    <!-- card  -->
    @foreach ($products as $product)
    <div class="col-md-3">
        <div class="card mb-3" style="border-radius: 10px ;min-height: 400px;" data-aos="fade-left">
            <img src="{{ $product->gallery->first()->photo() }}" class="card-img-top" alt="{{ $product->name }}" style="max-height:250px; margin:15px auto 0;">
            <div class="card-body ">
                <h5 class="card-title ">{{ $product->name }}</h5>
    
                <p class="harga "> <b>Rp. {{ number_format($product->price) }}</b> </p>
                <p>
                    <i class="fas fa-star bintang"></i>
                    <i class="fas fa-star bintang"></i>
                    <i class="fas fa-star bintang"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </p>
                
                <div class="buttons">
                    
                    <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary button-details btn-sm" style="width: 45%;">Beli</a>
                    
                    <a href="keranjang.html" class="btn btn-primary button-beli btn-sm" style="width: 45%;">Add to cart</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!--end card  -->
</div>
<div class="row justify-content-center">
    {{ $products->links() }}
</div>
@endsection