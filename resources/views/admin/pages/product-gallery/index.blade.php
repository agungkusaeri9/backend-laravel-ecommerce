@extends('admin.templates.default')
@section('content')
@include('admin.templates.partials.alert')
<div class="row mb-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="text-weight-bold">Filter</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
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
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="text-dark font-weight-bold">Galeri Produk</h6>
                <a href="{{ route('admin.product-galleries.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($productGalleries as $item)
                    <div class="col-md-2">
                        <img src="{{ $item->photo() }}" alt="" class="img-fluid" style="max-height: 100px; max-width:100px;" id="img" data-src="{{ $item->photo() }}" data-name="{{ $item->product->name }}" data-id="{{ $item->id }}">
                    </div>
                    @endforeach
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
        <div class="modal-footer">
            <form action="" method="post" id="formDelete">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
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
            var id = $(this).data('id');
            $('#imgModal').attr('src',src);
            $('.modal-title').text(name);
            $('#formDelete').attr('action',"{{ url('admin/product-galleries') }}" + '/' + id);
            $('#myModal').modal('show');
        })
    })
</script>
@endpush