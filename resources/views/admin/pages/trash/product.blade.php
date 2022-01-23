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
                <h6 class="text-dark font-weight-bold">Produk Sampah</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped wrap" id="data">
                        <thead>
                            <tr>
                                <th width="20" class="text-center">
                                    <input type="checkbox" name="all_id">
                                </th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Berat (g)</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th class="text-center" style="min-width:110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="product_id" value="{{ $item->id }}">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->weight }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp. {{ number_format($item->price) }}</td>
                                    <td>
                                        <form action="{{ route('admin.trash.product.restore',$item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-info">Pulihkan</button>
                                        </form>
                                        <form action="{{ route('admin.trash.product.delete',$item->id) }}" method="post" class="d-inline">
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