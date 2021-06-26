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
                <h6 class="text-primary font-weight-bold">Metode Pembayaran</h6>
                <a href="{{ route('admin.payments.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table responsive">
                    <table class="table table-bordered table-hover" id="data">
                        <thead>
                            <tr>
                                <th width=10>#</th>
                                <th>Nama</th>
                                <th>Nomor</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $pay)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pay->name }}</td>
                                    <td>{{ $pay->number }}</td>
                                    <td>{{ $pay->desc }}</td>
                                    <td>
                                        <a href="{{ route('admin.payments.edit',$pay->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.payments.destroy',$pay->id) }}" method="post" class="d-inline">
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