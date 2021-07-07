<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>UUID</th>
            <td>{{ $transaction->name }}</td>
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
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga Awal</th>
                        <th>Harga Akhir</th>
                    </tr>
                    @foreach ($transaction->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->amount }}</td>
                        <td>Rp. {{ number_format($detail->product->price) }}</td>
                        <td>Rp. {{ number_format($detail->product->price * $detail->amount) }}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <th>Pembayaran</th>
            <td>{{ $transaction->payment }}</td>
        </tr>
        <tr>
            <th>Kurir</th>
            <td>{{ $transaction->courier }}</td>
        </tr>
        <tr>
            <th>Receipt Number</th>
            <td>{{ $transaction->receipt_number }}</td>
        </tr>
        <tr>
            <th>Price Total</th>
            <td>Rp. {{ number_format($price_total) }}</td>
        </tr>
        <tr>
            <th>Ongkos Kirim</th>
            <td>Rp. {{ number_format($transaction->shipping_cost) }}</td>
        </tr>
        <tr>
            <th>Total Bayar</th>
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
            <th>Status</th>
            <td>
                @if ($transaction->transaction_status === 'SUCCESS')
                <span class="badge badge-success">SUCCESS</span>
                @elseif($transaction->transaction_status === 'PENDING')
                <span class="badge badge-warning">PENDING</span>
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