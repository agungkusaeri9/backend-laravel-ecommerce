@extends('admin.templates.default')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Edit Profil</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name ?? old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username ?? old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email ?? old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">No. Hp</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $user->phone_number ?? old('phone_number') }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                          <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="laki-laki" @if($user->gender === 'laki-laki') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="perempuan" @if($user->gender === 'perempuan') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                              </div>
                          </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{ $user->address ?? old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <img src="{{ $user->avatar() }}" alt="" class="img-fluid" style="height: 100px;width:100px">
                        </div>
                        <div class="col-9">
                            <label for="avatar">Avatar</label>
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        </div>
                        @error('avatar')
                            <div class="invalid-feedback d-inline">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection