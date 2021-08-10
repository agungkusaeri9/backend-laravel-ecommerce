<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}">
    <style>
        .page-break {
            page-break-after: always;
        }
        body{
            font-size: 12px;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <h5 class="text-center">Laporan Transaksi
                    @if ($date != NULL)
                        Harian
                    @elseif($month != NULL)
                        Bulanan
                    @endif
                </h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3">
                <table style="width:300px">
                    <tr>
                        <td>Tanggal Cetak</td>
                        <td>: {{ Carbon\Carbon::now()->translatedFormat('d F Y h:i:s') }}</td>
                    </tr>
                    @if ($date != NULL)
                    <tr>
                        <td class="text-left">Tanggal Transaksi</td>
                        <td>: {{ $date->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    @elseif($month != NULL)
                    <tr>
                        <td class="text-left">Bulan</td>
                        <td>: {{ $month }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-bordered">
                    <thead class="align-self-center">
                        <tr>
                            <th style="min-width: 20px;text-align:center">No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Sub Total</th>
                            <th class="text-center">Ongkir</th>
                            <th class="text-center">Transaksi Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $transaction->created_at->translatedFormat('d/m/Y') }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>{{ $transaction->email }}</td>
                                <td class="text-right">{{ number_format($transaction->transaction_total - $transaction->shipping_cost) }}</td>
                                <td class="text-right">{{ number_format($transaction->shipping_cost) }}</td>
                                <td class="text-right">{{ number_format($transaction->transaction_total) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" class="text-center font-weight-bold">Jumlah</td>
                            <td class="text-right font-weight-bold">Rp. {{ number_format($count_total) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap4/js/bootstrap.min.js') }}"></script>
</body>
</html>