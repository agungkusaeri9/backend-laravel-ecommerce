@extends('admin.templates.default')
@section('content')
@include('admin.templates.partials.alert')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-dark font-weight-bold">Data Produk</h6>
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.products.filter') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="from_price" class="col-sm-3 col-form-label">Mulai</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="from_price" class="form-control" placeholder="Harga Awal">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="to_price" class="col-sm-3 col-form-label">Sampai</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="to_price" class="form-control" placeholder="Harga Akhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                                        <div class="col-sm-9">
                                            <select name="category" id="category" name="category" class="form-control">
                                                <option value="">--Semua--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped wrap" id="data">
                        <thead>
                            <tr>
                                <th width="20" class="text-center">#</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Berat (g)</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th class="text-center" style="min-width:110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->weight }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp. {{ number_format($item->price) }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.show',$item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.products.edit',$item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.products.destroy',$item->id) }}" method="post" class="d-inline">
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
    var oTable = $('#data').DataTable();
})
</script>
@endpush