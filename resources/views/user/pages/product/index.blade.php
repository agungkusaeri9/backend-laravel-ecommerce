@extends('user.templates.default')
@section('content')
<section class="products my-0 py-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if ($category)
                <h2 class="section-title">Category {{ $category ->name}}</h2>
                @else
                <h2 class="section-title">All Product</h2>
                @endif
                <hr>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-6 col-md-4">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ $product->gallery[0]->photo() }}" alt="" />
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
            @endforeach
        </div>
        <div class="row mt-2 mb-4">
            <div class="col-md-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
@push('afterScripts')
<script>
    function addToCart(){
        $('#form-add-to-cart').submit();
    }
</script>
@endpush