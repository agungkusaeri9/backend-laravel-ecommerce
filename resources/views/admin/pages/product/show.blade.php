@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-primary font-weight-bold">Detial Produk "{{ $product->name }}"</h6>
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
                            <th>Harga</th>
                            <td>Rp. {{ number_format($product->price) }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $product->qty }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Foto Produk</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($product->gallery as $item)
                    <div class="col-lg-4">
                        <img src="{{ $item->photo() }}" alt="" class="img-thumbnail" style="height: 250px; width:250px;">
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
</div>
@endsection
