@extends('user.templates.default')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center page-title">Contact Us</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-1">
                <div class="card-body">
                    <h3 class="mb-4 font-weight-bold">{{ $store->name }}</h3>
                    <p>{{ $store->address }}</p>
                    <hr>
                    <p class="my-1">Email : {{ $store->email }}</p>
                    <p class="my-1">Phone : {{ $store->phone_number }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('inbox.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="example@example.com" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="web">Web (Optional)</label>
                            <input type="text" class="form-control" placeholder="https://example.com" name="web" id="web">
                        </div>
                        <div class="form-group">
                            <label for="text">Pesan</label>
                            <textarea name="text" id="text" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-primary px-4 py-2">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('afterStyles')
<style>
    .page-title{
        font-size: 18px !important;
    }
</style>
@endpush