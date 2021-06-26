@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @forelse ($product->gallery as $item)
                    <div class="col-lg-4">
                        <a href="{{ $item->photo() }}" data-lightbox="example-set">
                            <img src="{{ $item->photo() }}" alt="{{ $product->name }}" class="img-thumbnail img-fluid mb-1" style="width:200px;height:150px">
                        </a>
                    </div>
                    @empty
                    <div class="col-lg-12">
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
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-primary font-weight-bold">Detial Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama Produk</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Deskrpisi</th>
                            <td>{!! $product->desc !!}</td>
                        </tr>
                        <tr>
                            <th>Berat (g)</th>
                            <td>{{ $product->weight }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp. {{ number_format($product->price) }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $product->qty }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $product->created_at->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        @if ($product->updated_at)
                        <tr>
                            <th>Diedit</th>
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