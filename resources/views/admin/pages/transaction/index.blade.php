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
                <h6 class="text-primary font-weight-bold">Data Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table responsive">
                    <table class="table table-bordered table-hover" id="data">
                        <thead>
                            <tr>
                                <th width=10>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th width=100>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>Rp. {{ number_format( $item->transaction_total ) }}</td>
                                    <td>
                                        @if ($item->status->id == 1)
                                            <span class="badge badge-success">Berhasil</span>
                                        @elseif ($item->status->id == 2)
                                            <span class="badge badge-primary">Sedang Dikirim</span>
                                        @elseif ($item->status->id == 3)
                                            <span class="badge badge-warning">Menunggu Dikirim</span>
                                        @elseif ($item->status->id == 4)
                                            <span class="badge badge-info">Pembayaran Sukses</span>
                                        @elseif ($item->status->id == 5)
                                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                                        @elseif ($item->status->id == 6)
                                            <span class="badge badge-danger">Gagal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.transactions.show',$item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.transactions.edit',$item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.transactions.destroy',$item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash"></i></button>
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

<!-- Page level custom scripts -->
<script src="{{ asset('assets/sbadmin2/js/demo/datatables-demo.js') }}"></script>

<script>
    $(function(){
    var oTable = $('#data').DataTable()
})
</script>
@endpush