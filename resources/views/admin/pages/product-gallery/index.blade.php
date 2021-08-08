@extends('admin.templates.default')
@section('content')
@include('admin.templates.partials.alert')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-dark font-weight-bold">Galeri Produk</h6>
                <a href="{{ route('admin.product-galleries.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-5">
                        <form action="{{ route('admin.product-galleries.search') }}" method="post" class="d-inline">
                            @csrf
                            <div class="d-flex justify-content-between">
                                <select name="product" id="product" class="form-control d-inline product">
                                    <option selected value="">--Cari Berdasarkan Produk--</option>
                                    @foreach ($products as $product)
                                        <option @if($product->id == $product_id) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-sm btn-primary d-inline ml-2 px-3">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="data">
                        <thead>
                            <tr>
                                <th width=10>#</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Default</th>
                                <th class="text-center" style="min-width: 80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productGalleries as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $item->photo() }}" alt="" class="img-fluid" style="max-height: 100px; max-width:100px;" id="img" data-src="{{ $item->photo() }}" data-name="{{ $item->product->name }}">
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
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="" alt="" class="img-fluid w-100" id="imgModal">
        </div>
      </div>
    </div>
</div>
@endsection
@push('afterStyles')
<link href="{{ asset('assets/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
@endpush
@push('afterScripts')
<script src="{{ asset('assets/sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 37px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
</style>
<script>
    $(function(){
        var oTable = $('#data').DataTable();
        $('.product').select2();
        $('body').on('click','#img', function(){
            let src = $(this).data('src');
            let name = $(this).data('name');
            $('#imgModal').attr('src',src);
            $('.modal-title').text(name);
            $('#myModal').modal('show');
        })
    })
</script>
@endpush