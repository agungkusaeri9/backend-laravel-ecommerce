<table>
    <tr>
        <td>Tanggal Cetak</td>
        <td>{{ Carbon\Carbon::now()->translatedFormat('d/m/Y H:i:s') }}</td>
    </tr>
    @if ($data['date'] != NULL)
    <tr>
        <td class="text-left">Tanggal Transaksi</td>
        <td>{{ $data['date']->translatedFormat('l, d F Y') }}</td>
    </tr>
    @elseif($data['month'] != NULL)
    <tr>
        <td class="text-left">Bulan</td>
        <td>{{ $data['month'] }}</td>
    </tr>
    @endif
</table>
<table class="table table-sm table-bordered" border="1">
    <thead class="align-self-center thead-dark">
        <tr>
            <th style="min-width: 5px;text-align:center">No</th>
            <th style="width:20px;text-align:center">Tanggal</th>
            <th style="width:20px;text-align:center">Nama</th>
            <th style="width:25px;text-align:center">Email</th>
            <th style="width:20px;text-align:center">Sub Total</th>
            <th style="width:20px;text-align:center">Ongkir</th>
            <th style="width:20px;text-align:center">Transaksi Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['transactions'] as $transaction)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $transaction->created_at->translatedFormat('d/m/Y') }}</td>
                <td>{{ $transaction->name }}</td>
                <td>{{ $transaction->email }}</td>
                <td style="text-align:right">{{ number_format($transaction->transaction_total - $transaction->shipping_cost) }}</td>
                <td style="text-align:right">{{ number_format($transaction->shipping_cost) }}</td>
                <td style="text-align:right">{{ number_format($transaction->transaction_total) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align: center;font-weight:bold">Jumlah</td>
            <td style="text-align: right;font-weight:bold">Rp. {{ number_format($data['count_total']) }}</td>
        </tr>
    </tbody>
</table>
