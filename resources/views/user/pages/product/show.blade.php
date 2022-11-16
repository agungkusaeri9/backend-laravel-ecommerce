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
                            <img class="product-big-img" src="{{ $product->img() }}" alt="{{ $product->name }}" />
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
                        <div class="product-rating mt-4">
                            <div class="d-flex justify-content-between">
                                <h5>Produk Review</h5>
                                <span class="total_riview"></span>
                            </div>
                            <div class="pr-rating">

                            </div>
                            {{-- <div class="d-flex justify-content-end mt-2">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination p-0">
                                      <li class="page-item"><a class="page-link text-dark" href="#" style="font-size: 12px;padding:5px 10px"><</a></li>
                                      <li class="page-item active"><a class="page-link text-dark" href="#" style="font-size: 12px;padding:5px 10px">1</a></li>
                                      <li class="page-item"><a class="page-link text-dark" href="#" style="font-size: 12px;padding:5px 10px">2</a></li>
                                      <li class="page-item"><a class="page-link text-dark" href="#" style="font-size: 12px;padding:5px 10px">3</a></li>
                                      <li class="page-item"><a class="page-link text-dark" href="#" style="font-size: 12px;padding:5px 10px">></a></li>
                                    </ul>
                                </nav>
                            </div> --}}
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
                                <p class="font-weight-bold mb-0 pb-0">Terjual : {{ $product->sold }}</p>
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
<!-- <div class="related-products spad">
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
                        <img src="{{ $related->img() }}" alt="" />
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
</div> -->
@endsection
@push('afterStyles')
<style>
    .product-rating .des{
        font-size: 10px;
    }
</style>
@endpush
@push('afterScripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    <script>
        $(function(){
            var product_id = '{{ $product->id }}';
            $.ajax({
                url:'{{ route('products.rating-get') }}',
                type:'POST',
                data: {
                    product_id
                },
                dataType:'JSON',
                success: function(response){
                    console.log(response);
                    var xhtml = ``;
                    var tr = ``;
                    if(response.data.length > 0)
                    {
                        tr += response.data[0].total+''+'/5'+' ('+response.data[0].total_user+')';
                    }else{
                        tr += '0/5 (0)';
                    }
                    $('.total_riview').html(tr);
                    response.data.forEach(data => {
                        xhtml += '<div class="d-flex mt-4">';
                        xhtml += '<div class="img-profile">';
                        xhtml += '<img src="'+data.user_avatar+'" alt="" class="img-fluid rounded-circle" style="height:40px;width:40px">';
                        xhtml += '</div>';
                        xhtml += '<div class="des ml-3">';
                        xhtml += '<h6 style="font-size: 12px">'+data.user.name+'</h6>';
                        xhtml += '<div class="start-icon">';
                        for(i = 0; i < data.value;i++)
                        {
                            xhtml += '<img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:11px">';
                        };
                        var sisa = 5-data.value;
                        for(i = 0; i < sisa;i++)
                        {
                            xhtml += '<img src="{{ asset('assets/img/star-black.svg') }}" alt="" class="img-fluid" style="height:11px">';
                        };
                        xhtml += '</div>';
                        xhtml += '<div class="date-rating">';
                        xhtml += '<span>'+data.created+'</span>';
                        xhtml += '</div>';
                        xhtml += '<div class="comment">';
                        xhtml += '<p style="font-size: 13px">';
                        xhtml += data.comment;
                        xhtml += '</p>';
                        xhtml += '</div>';
                        xhtml += '</div>';
                        xhtml += '</div>';
                        xhtml += '<hr class="p-0 m-0">';
                    });
                    $('.pr-rating').html(xhtml);
                }
            })
        })
    </script>
@endpush
