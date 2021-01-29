@extends('admin.templates.default')
@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow h-100">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-primary font-weight-bold">Profile Toko</h6>
            </div>
            <div class="card-body">
                <div class="table responsive">
                    <table class="table table-borderless" id="data">
                        <tr>
                            <th style="min-width: 120px;">Nama Toko</th>
                            <td>{{ $store->name }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{!! $store->desc !!}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $store->address }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                <img src="{{ $store->photo() }}" alt="" class="img-fluid">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow h-100">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-primary font-weight-bold">Edit Toko</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store.update', $store->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Nama Toko</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $store->name ?? old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea name="desc" id="desc" cols="30" rows="5" class="form-control @error('desc') is-invalid @enderror">{{ $store->desc ?? old('desc') }}</textarea>
                        @error('desc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" cols="30" rows="5" class="form-control @error('address') is-invalid @enderror">{{ $store->address ?? old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary float-right">Update</button>
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