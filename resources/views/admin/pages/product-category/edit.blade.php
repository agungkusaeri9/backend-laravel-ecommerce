@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Edit Kategori Produk</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product-categories.update', $productCategory->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $productCategory->name ?? old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <img src="{{ $productCategory->icon() }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-9">
                            <label for="gambar">Gambar</label>
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                            @error('gambar')
                                <div class="invalid-feedback d-inline">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.product-categories.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection