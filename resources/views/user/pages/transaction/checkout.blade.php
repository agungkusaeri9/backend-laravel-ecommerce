@extends('user.templates.default')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h6>Pembayaran</h6>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('transaction.store', $cart->id) }}">
              @csrf
                <div class="form-group">
                    <label for="name">Nama Penerima</label>
                    <input type="text" placeholder="Nama" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">No. Hp</label>
                    <input type="text" placeholder="Nomor Hp" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') ?? auth()->user()->phone_number }}">
                    @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" cols="30" rows="5" class="form-control @error('address') is-invalid @enderror">{{ old('address') ?? auth()->user()->address }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="shipment_id">Jasa Pengantar</label>
                    <select name="shipment_id" id="shipment_id" class="form-control @error('shipment_id') is-invalid @enderror">
                        @foreach ($shipments as $shipment)
                            <option value="{{ $shipment->id }}">{{ $shipment->name }}</option>
                        @endforeach
                    </select>
                    @error('shipment_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="payment_id">Metode Pembayaran</label>
                    <select name="payment_id" id="payment_id" class="form-control @error('payment_id') is-invalid @enderror">
                        @foreach ($payments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->name . ' - ' . $payment->number }}</option>
                        @endforeach
                    </select>
                    @error('payment_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right" style="color: white;">Lanjutkan</button>
                </div>

          </form>
        </div>
      </div>
    </div>
</div>
@endsection