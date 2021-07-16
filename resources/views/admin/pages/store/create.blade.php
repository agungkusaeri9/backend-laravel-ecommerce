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
    <div class="col-lg-12">
        <div class="card shadow h-100">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-primary font-weight-bold">Profil Toko</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $store->email ?? old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">No. Telpon</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $store->phone_number ?? old('phone_number') }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea name="desc" id="desc" cols="30" rows="5" class="form-control @error('desc') is-invalid @enderror">{{ $store->desc ??  old('desc') }}</textarea>
                        @error('desc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <select name="city" id="city" class="form-control">
                            <option value="" disabled selected>--Pilih Kota--</option>
                            @foreach ($cities as $city)
                                <option @if($city->city_id === $store->city) selected @endif value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        @error('city')
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
                        <label for="facebook_link">Link Facebook</label>
                        <input type="text" name="facebook_link" id="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" value="{{ $store->facebook_link ?? old('facebook_link') }}">
                        @error('facebook_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="instagram_link">Link Instagram</label>
                        <input type="text" name="instagram_link" id="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" value="{{ $store->instagram_link ?? old('instagram_link') }}">
                        @error('instagram_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tele_token">Telegram Token</label>
                        <input type="text" name="tele_token" id="tele_token" class="form-control @error('tele_token') is-invalid @enderror" value="{{ $store->tele_token ?? old('tele_token') }}">
                        @error('tele_token')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="group_chatId">Telegram Group Chat ID</label>
                        <input type="text" name="group_chatId" id="group_chatId" class="form-control @error('group_chatId') is-invalid @enderror" value="{{ $store->group_chatId ?? old('group_chatId') }}">
                        @error('group_chatId')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            @if ($store)
                            <img src="{{ $store->logo() }}" alt="" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <label for="logo">Foto</label>
                            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                            @error('logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
    </style>
@endpush
@push('afterScripts')
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<script>
    CKEDITOR.replace('desc');
    $('#city').select2();
</script>
@endpush