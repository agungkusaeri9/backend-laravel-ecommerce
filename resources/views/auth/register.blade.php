@extends('auth.templates.default')
@section('title','Register')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5 mx-auto col-lg-6">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                    </div>
                    <form class="user" method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group"> 
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                                placeholder="Nama Lengkap" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                                placeholder="Alamat Email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="exampleInputPassword" placeholder="Password" name="password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                    id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="#">Lupa Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">Sudah Punya Akun? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
