@extends('admin.templates.default')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="alert alert-warning">
            <strong>Perhatian!</strong>
            <p>Sebelum menambahkan kurir baru, pastikan akun rajaongkir anda versi pro. Dan jika versi trial dan anda menambahkan kurir selain JNE maka akan mengalami error ketika user checkout.</p>
        </div>
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Edit Kurir</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.couriers.update',$item->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ $item->code ?? old('code') }}">
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $item->name ?? old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="" selected disabled>- Pilih Status -</option>
                            <option @if($item->status == 0) selected @endif value="0">Tidak Aktif</option>
                            <option @if($item->status == 1) selected @endif value="1">Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.couriers.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection