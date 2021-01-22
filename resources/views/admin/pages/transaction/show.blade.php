@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-primary font-weight-bold">Detail Transaksi "{{ $transaction->uuid }}"</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>UUID</th>
                            <td>{{ $transaction->uuid }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $transaction->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $transaction->email }}</td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td>{{ $transaction->phone_number }}}}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $transaction->address }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp. {{ number_format($transaction->transaction_total) }}</td>
                        </tr>
                        <tr>
                            <th>Jasa Pengiriman</th>
                            <td>{{ $transaction->shipment->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ $transaction->payment->name }}</td>
                        </tr>
                        <tr>
                            <th>Pembelian</th>
                            <td class="table-responsive">
                                <table class="table table-bordered w-100">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                    </tr>
                                    @foreach ($transaction->details as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->category->name }}</td>
                                        <td>Rp. {{ number_format($item->product->price) }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-block btn-warning">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
