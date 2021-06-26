@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Edit Transaksi {{ $transaction->uuid }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $transaction->name ?? old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $transaction->email ?? old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">No Hp</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $transaction->phone_number ?? old('phone_number') }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" cols="30" rows="5" class="form-control @error('address') is-invalid @enderror" >{{ $transaction->address ?? old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="payment_id">Pembayaran</label>
                        <select name="payment_id" id="" class="form-control">
                            @foreach ($payments as $item)
                                <option @if($item->id == $transaction->payment_id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('transaction_status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="shipment_id">Jasa Pengiriman</label>
                        <select name="shipment_id" id="" class="form-control">
                            <option value="" selected>--Jasa Pengiriman--</option>
                            @foreach ($shipments as $item)
                                <option @if($item->id == $transaction->shipment_id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('transaction_status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="receipt_number">No Resi</label>
                        <input type="text" name="receipt_number" class="form-control @error('receipt_number') is-invalid @enderror" value="{{ $transaction->receipt_number ?? old('receipt_number') }}">
                        @error('receipt_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary">Update</button>
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