@extends('user.templates.default')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h5 data-aos="fade-left"><b>Riwayat Transaksi</b></h5>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($transactions as $transaction)
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between">
                                <h5>#{{ $transaction->uuid }}</h5>
                                @if ($transaction->status->id == 1)
                                    <span class="badge badge-success">Berhasil</span>
                                @elseif ($transaction->status->id == 2)
                                    <span class="badge badge-primary">Sedang Dikirim</span>
                                @elseif ($transaction->status->id == 3)
                                    <span class="badge badge-warning">Menunggu Dikirim</span>
                                @elseif ($transaction->status->id == 4)
                                    <span class="badge badge-info">Pembayaran Sukses</span>
                                @elseif ($transaction->status->id == 5)
                                    <span class="badge badge-warning">Menunggu Pembayaran</span>
                                @elseif ($transaction->status->id == 6)
                                    <span class="badge badge-danger">Gagal</span>
                                @endif
                            </div>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Jumlah Produk</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->details as $detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ number_format($detail->product->price) }}</td>
                                            <td>{{ $detail->product_total }}</td>
                                            <td>{{ $detail->price_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <p>Jumlah yang harus dibayar : Rp. {{ number_format($transaction->transaction_total) }}</p>
                                <a href="{{ route('transaction.confirmation', $transaction->uuid) }}" class="btn btn-sm btn-outline-primary">Konfirmasi Pembayaran</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection