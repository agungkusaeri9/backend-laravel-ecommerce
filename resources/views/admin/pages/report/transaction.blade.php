@extends('admin.templates.default')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-2">
            <div class="card-header">
                <h6 class="text-dark font-weight-bold">Filter</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('admin.report.transactions.filter') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-4 col-form-label">Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" name="date" id="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="month" class="col-sm-3 col-form-label">Bulan</label>
                                                <div class="col-sm-9">
                                                    <select name="month" id="month" class="form-control">
                                                        <option value="">-- Semua --</option>
                                                        @foreach ($months as $item)
                                                        <option value="{{ $item['no'] }}">{{ $item['nama'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <a href="" class="btn btn-info"><i class="fas fa-print"></i> Cetak</a>
                        <a href="" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-dark font-weight-bold">
                    Laporan Transaksi
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="data">
                        <thead>
                            <tr>
                                <th>#</th>
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
                                    <td>{{ $loop->iteration }}</td>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('afterStyles')
<link href="{{ asset('assets/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('afterScripts')
<script src="{{ asset('assets/sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(function(){
    var oTable = $('#data').DataTable();
    $('button[type=reset]').on('click', function(){
        $('#date').attr('value','');
        $('#month').val('');
    })
})
</script>
@endpush