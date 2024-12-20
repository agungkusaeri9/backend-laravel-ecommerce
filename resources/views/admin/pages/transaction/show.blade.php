<div class="table-responsive">
    <table class="table table-bordered table-striped">
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
            <th>Alamat</th>
            <td>{{ $transaction->address }}</td>
        </tr>
        <tr>
            <th>Produk</th>
            <td>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga Awal</th>
                            <th>Harga Akhir</th>
                        </tr>
                        @foreach ($transaction->details as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->amount }}</td>
                            <td>{{ number_format($detail->product->price) }}</td>
                            <td>{{ number_format($detail->product->price * $detail->amount) }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <th>Pembayaran</th>
            <td>
                @if (!$transaction->payment)
                    -
                @else
                {{ $transaction->payment->name . ' - ' . $transaction->payment->number . ' ('.$transaction->payment->desc .')' }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Kurir</th>
            <td>{{ $transaction->courier }}</td>
        </tr>
        <tr>
            <th>Nomor Resi</th>
            <td>{{ $transaction->receipt_number }}</td>
        </tr>
        <tr>
            <th>Sub Total</th>
            <td>Rp. {{ number_format($price_total) }}</td>
        </tr>
        <tr>
            <th>Ongkos Kirim</th>
            <td>Rp. {{ number_format($transaction->shipping_cost) }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>Rp. {{ number_format($transaction->transaction_total) }}</td>
        </tr>
        <tr>
            <th>Bukti Pembayaran</th>
            <td>
                @if ($transaction->proof_of_payment !== NULL)
                <a href="{{ route('admin.transactions.download', $transaction->id) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download</a>
                @else
                Not Uploaded
                @endif
            </td>
        </tr>
        <tr>
            <th>Waktu</th>
            <td>{{ $transaction->created_at->translatedFormat('d/m/Y H:i:s') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if ($transaction->transaction_status === 'SUCCESS')
                <span class="badge badge-success">SUCCESS</span>
                @elseif($transaction->transaction_status === 'PENDING')
                <span class="badge badge-warning">PENDING</span>
                @elseif($transaction->transaction_status === 'DELIVERY')
                <span class="badge badge-info">DELIVERY</span>
                @else
                <span class="badge badge-danger">FAILED</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Aksi</th>
            <td>
                @if ($transaction->transaction_status === 'SUCCESS')
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=PENDING" class="btn btn-sm btn-warning">SET PENDING</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=DELIVERY" class="btn btn-sm btn-info">SET DELIVERY</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=FAILED" class="btn btn-sm btn-danger">SET FAILED</a>
                @elseif($transaction->transaction_status === 'PENDING')
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=SUCCESS" class="btn btn-sm btn-success">SET SUCCESS</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=DELIVERY" class="btn btn-sm btn-info">SET DELIVERY</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=FAILED" class="btn btn-sm btn-danger">SET FAILED</a>
                @elseif($transaction->transaction_status === 'DELIVERY')
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=SUCCESS" class="btn btn-sm btn-success">SET SUCCESS</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=PENDING" class="btn btn-sm btn-warning">SET PENDING</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=FAILED" class="btn btn-sm btn-danger">SET FAILED</a>
                @else
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=SUCCESS" class="btn btn-sm btn-success">SET SUCCESS</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=DELIVERY" class="btn btn-sm btn-info">SET DELIVERY</a>
                <a href="{{ route('admin.transactions.set', $transaction->id) }}?status=PENDING" class="btn btn-sm btn-warning">SET PENDING</a>
                @endif
            </td>
        </tr>
    </table>
</div>
