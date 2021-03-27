@extends('user.templates.default')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h6>Konfirmasi Pembayaran</h6>
        </div>
        <div class="card-body">
          <form method="post" action="">
              @csrf
                <div class="form-group">
                    <label for="payment_id">Metode Pembayaran</label>
                    <input type="text" readonly value="{{ $transaction->payment->name . ' - ' . $transaction->payment->number }}" class="form-control">
                    @error('payment_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jml_bayar">Jumlah Bayar</label>
                    <input type="text" readonly value="Rp. {{ number_format($transaction->transaction_total) }}" class="form-control">
                    @error('jml_bayar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Bukti Pmbayaran</label>
                    <input type="file" value="{{ $transaction->payment->name . ' - ' . $transaction->payment->number }}" class="form-control">
                    @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="note">Catatan Khusus</label>
                    <textarea name="note" id="" class="form-control" cols="30" rows="5"></textarea>
                    @error('note')
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