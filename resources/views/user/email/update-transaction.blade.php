<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaksi</title>
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
        }

        .wrapper {
            position: relative;
            width: 100%;
        }

        tr {
            text-align: left;
        }

        table.info-transaction {
            margin-top: 40px;
        }

        table.info-transaction tr th,
        table.info-pembayaran tr th {
            font-weight: normal;
        }

        table.detail-produk {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            width: 100%;
        }

        table.detail-produk thead tr {
            background-color: #575353;
            color: #ffffff;
            text-align: left;
        }

        table.detail-produk th,
        table.detail-produk td {
            padding: 12px 15px;
        }

        table.detail-produk tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table.detail-produk tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table.detail-produk tbody tr:last-of-type {
            border-bottom: 2px solid #444645;
        }

        table.detail-produk tbody tr.active-row {
            font-weight: bold;
            color: #5c5e5d;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <p>Halo {{ $data->user->name }}, transaksi anda telah kami verifikasi.
            <br>
            Untuk lebih lengkapnya ada dibawah ini :</p>

        <table class="info-transaction">
            <tr>
                <th>UUID</th>
                <td> : </td>
                <td>{{ $data->uuid }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td> : </td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td> : </td>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td> : </td>
                <td>{{ $data->address }}</td>
            </tr>
            <tr>
                <th>Sub Total</th>
                <td> : </td>
                <td>Rp. {{ number_format($data->transaction_total-$data->shipping_cost) }}</td>
            </tr>
            <tr>
                <th>Ongkos Kirim</th>
                <td> : </td>
                <td>Rp. {{ number_format($data->shipping_cost) }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td> : </td>
                <td>Rp. {{ number_format($data->transaction_total) }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td> : </td>
                <td>{{ $data->created_at->translatedFormat('d/m/Y H:i:s') }}</td>
            </tr>
        </table>

        <table class="detail-produk">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Harga Produk</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->notes }}</td>
                    <td>{{ $detail->amount }}</td>
                    <td>Rp. {{ number_format($detail->product->price) }}</td>
                    <th>Rp. {{ number_format($detail->product->price*$detail->amount) }}</th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <Th style="text-align:center" colspan="5">Total</Th>
                    <th>Rp. {{ number_format($data->transaction_total-$data->shipping_cost) }}</th>
                </tr>
            </tfoot>
        </table>

        <div style="display: flex;justify-content: space-between;">
            <table class="info-pembayaran">
                <tr>
                    <th>Pembayaran</th>
                    <td> : </td>
                    <td>{{ $data->payment->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nomor</th>
                    <td> : </td>
                    <td>{{ $data->payment->number ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td> : </td>
                    <td>{{ $data->payment->desc ?? '-' }}</td>
                </tr>
            </table>
            <table class="info-pembayaran">
                <tr>
                    <th>Kurir</th>
                    <td> : </td>
                    <td>{{ $data->courier }}</td>
                </tr>
                <tr>
                    <th>Nomor Resi</th>
                    <td> : </td>
                    <td>{{ $data->receipt_number ?? '-' }}</td>
                </tr>
            </table>
        </div>
        <p style="margin-top: 30px;">
            Silahkan tunggu paket anda sampe di tujuan, jika ada suatu kendala anda bisa menghubungi kami via email {{ $store->email }} ataupun whatsapp {{ $store->phone_number }}.
        </p>

        <div style="margin-top: 50px;">
            <p>Termakasih</p>
            <p>{{ $store->name }}</p>
        </div>
    </div>
</body>

</html>
