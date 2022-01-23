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
<div class="row mb-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="text-weight-bold">Filter</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transactions.filter') }}" method="post" class="d-inline">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" name="date" class="form-control" @if($date) value="{{ $date }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                @csrf
                                <div class="d-flex justify-content-between">
                                    <select name="status" id="status" class="form-control d-inline status">
                                        <option selected value="" disabled >-- Berdasarkan Status --</option>
                                        <option @if($status === "") selected @endif value="">Semua</option>
                                        <option @if($status === 'SUCCESS') selected @endif value="SUCCESS">Sukses</option>
                                        <option @if($status === 'PENDING') selected @endif value="PENDING">Pending</option>
                                        <option @if($status === 'DELIVERY') selected @endif value="DELIVERY">Dalam Pengiriman</option>
                                        <option @if($status === 'FAILED') selected @endif value="FAILED">Gagal</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary d-inline ml-2 px-3">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-dark font-weight-bold">Data Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped nowrap" id="data">
                        <thead>
                            <tr>
                                <th width=10>#</th>
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
                            @foreach ($transactions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
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
                                        @if ($item->transaction_status === 'SUCCESS')
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=PENDING" class="btn btn-sm btn-warning"><i class="fas fa-spinner"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=DELIVERY" class="btn btn-sm btn-info"><i class="fas fa-truck"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=FAILED" class="btn btn-sm btn-danger"><i class="fas fa-window-close"></i> </a>
                                        @elseif($item->transaction_status === 'PENDING')
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=SUCCESS" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=DELIVERY" class="btn btn-sm btn-info"><i class="fas fa-truck"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=FAILED" class="btn btn-sm btn-danger"><i class="fas fa-window-close"></i> </a>
                                        @elseif($item->transaction_status === 'DELIVERY')
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=SUCCESS" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=PENDING" class="btn btn-sm btn-warning"><i class="fas fa-spinner"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=FAILED" class="btn btn-sm btn-danger"><i class="fas fa-window-close"></i> </a>
                                        @else
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=SUCCESS" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=DELIVERY" class="btn btn-sm btn-info"><i class="fas fa-truck"></i></a>
                                        <a href="{{ route('admin.transactions.set', $item->id) }}?status=PENDING" class="btn btn-sm btn-warning"><i class="fas fa-spinner"></i></a>
                                        @endif
                                        <a href="#" class="btn btn-sm btn-warning showBtn" data-toggle="modal" data-target="#showModal" data-id="{{ $item->id }}" data-url="{{ route('admin.transactions.show', $item->id) }}" data-uuid="{{ $item->uuid }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
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
<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    var oTable = $('#data').DataTable();
})
</script>
<script>
    $('#showModal').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var modal = $(this);
        var id = button.data('id');
        var url = button.data('url');
        var uuid = button.data('uuid');
        modal.find('.modal-title').html('Transaction Detail ' + uuid);
        modal.find('.modal-body').load(url)
    })
</script>
@endpush