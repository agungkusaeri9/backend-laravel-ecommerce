@extends('admin.templates.default')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Edit Foto</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product-galleries.update', $productGallery->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="product_id">Nama Produk</label>
                        <input type="text" name="product_id" class="form-control" value="{{ $productGallery->product->name }}" readonly>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <img src="{{ $productGallery->photo() }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-9">
                            <label for="photo">Gambar</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                            @error('photo')
                                <div class="invalid-feedback d-inline">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-4 pt-0">Jadikan Default</legend>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_default" id="inlineRadio1" value="1" @if($productGallery->is_default == 1) checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_default" id="inlineRadio2" value="0"  @if($productGallery->is_default == 0) checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                          </div>
                        </div>
                      </fieldset>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.product-galleries.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection