@extends('admin.templates.default')
@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-dark font-weight-bold">Sampah Transaksi</h6>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                <table class="table table-bordered table-striped nowrap" id="data">
                    <thead>
                        <tr>
                            <th width=10>
                                <input type="checkbox" name="all_id">
                            </th>
                            <th>UUID</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width=200>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="transaction_id" value="{{ $item->id }}">
                                </td>
                                <td>{{ $item->uuid }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>{{ $item->address }}</td>
                                <td>Rp. {{ number_format( $item->transaction_total ) }}</td>
                                <td>
                                    @if ($item->transaction_status == 'SUCCESS')
                                    <span class="badge badge-success">SUCCESS</span>
                                    @elseif ($item->transaction_status == 'PENDING')
                                    <span class="badge badge-warning">PENDING</span>
                                    @elseif ($item->transaction_status == 'DELIVERY')
                                    <span class="badge badge-info">DELIVERY</span>
                                    @elseif ($item->transaction_status == 'FAILED')
                                    <span class="badge badge-danger">FAILED</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->translatedFormat('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    <form action="{{ route('admin.trash.transaction.restore',$item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-info">Pulihkan</button>
                                    </form>
                                    <form action="{{ route('admin.trash.transaction.delete',$item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus Permanen</button>
                                    </form>
                                </td>
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
    var oTable = $('#data').DataTable({
        responsive: true
    })
})
</script>
@endpush