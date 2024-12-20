@extends('admin.templates.default')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Edit Produk</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="image">Foto Utama</label>
                            <img src="{{ $product->img() }}" alt="" class="img-fluid" style="max-height: 80px;max-width:80px">
                        </div>
                        <div class="col-md-9 align-self-center">
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name ?? old('name') }}">
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
                                <option @if($item->id == $product->product_category) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
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
                        @error('desc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">Berat (g)</label>
                        <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ $product->weight ?? old('weight') }}">
                        @error('weight')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price ?? old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="qty">Stok</label>
                        <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ $product->qty ?? old('qty') }}">
                        @error('qty')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Update</button>
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
