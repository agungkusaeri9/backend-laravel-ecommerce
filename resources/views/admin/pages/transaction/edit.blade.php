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
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $transaction->name ?? old('name') }}" readonly>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $transaction->email ?? old('email') }}" readonly>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">No Hp</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $transaction->phone_number ?? old('phone_number') }}" readonly>
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" cols="30" rows="5" disabled class="form-control @error('address') is-invalid @enderror" >{{ $transaction->address ?? old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="payment">Pembayaran</label>
                        <select name="payment" id="" class="form-control" disabled>
                            @foreach ($payments as $item)
                                <option @if($item->name == $transaction->payment) selected @endif value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('transaction_status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="courier">Jasa Pengiriman</label>
                        <select name="courier" id="" class="form-control" disabled>
                            <option value="">--Jasa Pengiriman--</option>
                            @foreach ($couriers as $courier)
                                <option @if($courier->code == $transaction->courier) selected @endif value="{{ $courier->code }}">{{ $courier->name }}</option>
                            @endforeach
                        </select>
                        @error('transaction_status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="transaction_status">Status</label>
                        <select name="transaction_status" id="transaction_status" class="form-control">
                            <option @if($transaction->transaction_status === 'SUCCESS') selected @endif value="SUCCESS">SUCCESS</option>
                            <option @if($transaction->transaction_status === 'PENDING') selected @endif value="PENDING">PENDING</option>
                            <option @if($transaction->transaction_status === 'DELIVERY') selected @endif value="DELIVERY">DELIVERY</option>
                            <option @if($transaction->transaction_status === 'FAILED') selected @endif value="FAILED">FAILED</option>
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
