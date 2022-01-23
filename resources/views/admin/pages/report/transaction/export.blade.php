<table class="table table-bordered table-striped" id="data">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Sub Total</th>
            <th>Ongkos Kirim</th>
            <th>Total Transaksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $transaction->created_at->translatedFormat('d/m/Y') }}</td>
                <td>{{ $transaction->name }}</td>
                <td>{{ $transaction->email }}</td>
                <td>{{ number_format($transaction->transaction_total-$transaction->shipping_cost) }}</td>
                <td>{{ number_format($transaction->shipping_cost) }}</td>
                <td>{{ number_format($transaction->transaction_total) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>