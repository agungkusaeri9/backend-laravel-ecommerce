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
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            @if (session('resent'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>Kami berhasil mengirimkan link verifikasi ke email anda. Silahkan cek email untuk proses verifikasi.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h6 class="text-center mb-4">Verifikasi Email</h6>
                    <p>Silahkan cek email anda untuk proses verifikasi akun.</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Kirim Ulang</button>.
                    </form>
                    <hr>
                    <form class="d-inline" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Logout</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
