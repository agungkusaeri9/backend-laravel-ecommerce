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
                <h6 class="text-primary font-weight-bold">Galeri Produk</h6>
                <a href="{{ route('admin.product-galleries.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table responsive">
                    <table class="table table-bordered table-hover" id="data">
                        <thead>
                            <tr>
                                <th width=10>#</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Default</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productGalleries as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $item->photo() }}" alt="" class="img-fluid" style="max-height: 200px; max-width:200px;">
                                    </td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>
                                        @if ($item->is_default == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product-galleries.edit',$item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.product-galleries.destroy',$item->id) }}" method="post" class="d-inline">
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