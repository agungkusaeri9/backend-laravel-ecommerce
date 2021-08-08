@extends('admin.templates.default')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Tambah Produk</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="photo">Foto Produk</label>
                        <input type="file" name="photo[]" class="form-control @error('name') is-invalid @enderror" multiple>
                        @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Kategori</label>
                        <select name="product_category" class="form-control @error('product_category') is-invalid @enderror" id="product_category">
                            <option value="" selected disabled>--Kategori--</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror">{{ $product->desc ?? old('desc') }}</textarea>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">Berat (g)</label>
                        <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}">
                        @error('weight')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="qty">Stok</label>
                        <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}">
                        @error('qty')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('afterStyles')
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
@endpush
@push('afterScripts')

<script>
    CKEDITOR.replace('desc');
</script>
@endpush