@extends('admin.templates.default')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Edit Metode Pembayaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payments.update', $payment->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group row">
                        <div class="col-2">
                            <label for="icon">Ikon</label>
                            <img src="{{ $payment->icon() }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-10 align-self-center">
                            <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}">
                            @error('icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $payment->name ?? old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="number">Nomor</label>
                        <input type="numeric" name="number" class="form-control @error('number') is-invalid @enderror" value="{{ $payment->number ?? old('number') }}">
                        @error('number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea name="desc" id="desc" cols="30" rows="4" class="form-control @error('desc') is-invalid @enderror">{{ $payment->desc ?? old('desc') }}</textarea>
                        @error('desc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection