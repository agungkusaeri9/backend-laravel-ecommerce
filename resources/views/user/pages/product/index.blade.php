@extends('user.templates.default')
@section('content')
<section class="products my-0 py-0">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if ($category)
                <h2 class="section-title text-left">Kategori {{ $category ->name}}</h2>
                @else
                <h2 class="section-title text-left">Semua Produk</h2>
                @endif
               </div>
               <div class="col-md-3">
                   <form action="{{ route('products.search') }}" method="get">
                    <div class="form-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari produk kesukaan anda..." value="{{ $q ?? '' }}">
                    </div>
                </form>
            </div>
            <hr>
        </div>
        <div class="row">
            @forelse ($products as $product)
            <div class="col-6 col-md-4">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ $product->img() }}" alt="" />
                        <ul>
                            <li class="w-icon active" onclick="addToCart()">
                                <a href="javascript:void(0)"><i class="icon_bag_alt"></i></a>
                                <form action="{{ route('cart.store') }}" method="post" class="d-none" id="form-add-to-cart">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                </form>
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
            @empty
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p class="text-center">Produk tidak ada.</p>
                </div>
            </div>
            @endforelse
        </div>
        <div class="row mt-2 mb-4">
            <div class="col-md-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
@if ($title !== 'Semua Produk')
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-title">Produk Lainnya</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($product_lainnya  as $pl)
            <div class="col-lg-3 col-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ $pl->img() }}" alt="" />
                        <ul>
                            <li class="w-icon active" onclick="addToCart()">
                                <a href="javascript:void(0)"><i class="icon_bag_alt"></i></a>
                                <form action="{{ route('cart.store') }}" method="post" class="d-none" id="form-add-to-cart">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $pl->id }}">
                                    <input type="hidden" name="price" value="{{ $pl->price }}">
                                </form>
                            </li>
                            <li class="quick-view"><a href="{{ route('product.show', $pl->slug) }}">+ Quick View</a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">{{ $pl->category->name }}</div>
                        <a href="#">
                            <h5>{{ $pl->name }}</h5>
                        </a>
                        <div class="product-price">
                            Rp. {{ number_format($pl->price) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
@push('afterScripts')
<script>
    function addToCart(){
        $('#form-add-to-cart').submit();
    }
</script>
@endpush
