@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Tambah User</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">No. Hp</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                          <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="laki-laki" checked>
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="perempuan">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                              </div>
                          </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Role</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="" selected disabled>--Role--</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                            <div class="invalid-feedback d-inline">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection