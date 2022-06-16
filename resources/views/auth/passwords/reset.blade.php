@extends('auth.templates.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-5 align-self-center">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="logo text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ $store->logo() }}" alt="" class="img-fluid"
                                style="max-height: 120px;max-width:120px">
                            <h2 class="text-white font-weight-bold mt-3">{{ $store->name }}</h2>
                        </a>
                    </div>
                </div>
            </div>
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p> {{ session('status') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card o-hidden border-0 shadow-lg mb-5 mt-2">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Buat Password Baru</h1>
                                </div>
                                <form class="user" method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address..." name="email"
                                            value="{{ $email ?? old('email') }}" readonly autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="exampleInputpassword" aria-describedby="password"
                                            placeholder="Password Baru" name="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                            id="exampleInputpassword" aria-describedby="password"
                                            placeholder="Konfirmasi Password Baru" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Buat Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
