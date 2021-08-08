@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-5 mb-3">
        <div class="card">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Foto Produk</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($product->gallery as $item)
                    <div class="col-6">
                        <a href="{{ $item->photo() }}" data-lightbox="example-set">
                            <img src="{{ $item->photo() }}" alt="{{ $product->name }}" class="img-thumbnail img-fluid mb-1">
                        </a>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-danger text-center">
                            <strong>Foto Tidak Ditemukan!</strong>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Detail Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <tr>
                            <td>Nama Produk</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Deskrpisi</td>
                            <td>{!! $product->desc !!}</td>
                        </tr>
                        <tr>
                            <td>Berat (g)</td>
                            <td>{{ $product->weight }} g</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>{{ $product->qty }}</td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>Rp. {{ number_format($product->price) }}</td>
                        </tr>
                        <tr>
                            <td>Dibuat</td>
                            <td>{{ $product->created_at->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        @if ($product->updated_at)
                        <tr>
                            <td>Diedit</td>
                            <td>{{ $product->updated_at->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('afterStyles')
<link rel="stylesheet" href="{{ asset('assets/lightbox/dist/css/lightbox.min.css') }}">
@endpush
@push('afterScripts')
<script src="{{ asset('assets/lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>
@endpush