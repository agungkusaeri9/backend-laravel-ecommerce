@extends('user.templates.default')
@section('content')
<div class="container">
    @include('user.templates.partials.alert')
    <div class="row">
        <div class="col-md-4">
            @include('user.templates.partials.sidebar-user')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>ID</th>
                                <td>{{ $transaction->uuid }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $transaction->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $transaction->email }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $transaction->address }}</td>
                            </tr>
                            <tr>
                                <th>Produk</th>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Harga Total</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($transaction->details as $detail)
                                        <tr>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ $detail->amount }}</td>
                                            <td>{{ number_format($detail->product->price) }}</td>
                                            <td>{{ number_format($detail->product->price * $detail->amount) }}</td>
                                            <td>
                                                @if ($transaction->transaction_status === 'SUCCESS')
                                                    @if ($detail->isRating())
                                                    <span class="badge badge-success">Anda Memberikan Rating</span>
                                                    @else
                                                    <a href="javascript:void(0)" class="btn btnAddRating btn-sm btn-warning" data-productid="{{ $detail->product_id }}">Beri Rating</a>
                                                    @endif
                                                @else
                                                <span>-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-center font-weight-bold" colspan="3">Total</td>
                                            <td colspan="3" class="text-center font-weight-bold">Rp. {{ number_format($price_total) }}</td>
                                        </tr>
                                        
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>Pembayaran</th>
                                <td>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $transaction->payment->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor</th>
                                            <td>{{ $transaction->payment->number ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Penerima</th>
                                            <td>{{ $transaction->payment->desc ?? ''}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>Kurir</th>
                                <td>{{ $transaction->courier }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Resi</th>
                                <td>{{ $transaction->receipt_number ?? ' Tidak Ada' }}</td>
                            </tr>
                            <tr>
                                <th>Biaya Pengiriman</th>
                                <td>Rp. {{ number_format($transaction->shipping_cost) }}</td>
                            </tr>
                            <tr>
                                <th>Total Bayar</th>
                                <td>Rp. {{ number_format($transaction->transaction_total) }}</td>
                            </tr>
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td>
                                    @if ($transaction->proof_of_payment !== NULL)
                                    <span class="badge badge-success">Berhasil Diupload</span>
                                    <span class="badge badge-warning badgeLihat" data-link="{{ asset('storage/'.$transaction->proof_of_payment) }}">lihat</span>
                                    <span class="badge badge-danger badgeDelete">hapus</span>
                                    <form action="{{ route('transactions.delete-proof') }}" method="post" class="d-inline" id="formDeleteBukti">
                                        <input type="number" name="transaction_id" value="{{ $transaction->id }}" hidden>
                                        @csrf
                                    </form>
                                    @else
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalUpload" id="btnUpload">
                                       <i class="fas fa-upload"></i> Upload
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($transaction->transaction_status === 'SUCCESS')
                                    <span class="badge badge-success">SUCCESS</span>
                                    @elseif($transaction->transaction_status === 'PENDING')
                                    <span class="badge badge-warning">PENDING</span>
                                    @elseif($transaction->transaction_status === 'DELIVERY')
                                    <span class="badge badge-info">DELIVERY</span>
                                    @else
                                    <span class="badge badge-danger">FAILED</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('transactions.upload-proof') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input type="hidden" value="{{ $transaction->uuid }}" name="uuid">
                <div class="form-group">
                    <label for="image">Bukti Pembayaran (Gambar)</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="modalLihatBukti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="" class="img-fluid w-100 imgModalBukti" alt="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modalAddRating" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Beri Rating Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('products.rating-store') }}" method="post">
            @csrf
            <input type="number" id="product_id_rating" name="product_id" hidden>
            <div class="modal-body">
                <div class="form-group">
                    <label for="comment">Komentar Anda</label>
                    <textarea name="comment" id="comment" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="value">Rating</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="value" id="value1" value="1">
                        <label class="form-check-label" for="value1">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="value" id="value2" value="2">
                        <label class="form-check-label" for="value2">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="value" id="value3" value="3">
                        <label class="form-check-label" for="value3">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="value" id="value4" value="4">
                        <label class="form-check-label" for="value4">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="value" id="value5" value="5">
                        <label class="form-check-label" for="value5">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                            <img src="{{ asset('assets/img/star-yellow.svg') }}" alt="" class="img-fluid" style="height:18px">
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@push('afterStyles')
<style>
    .badgeLihat:hover{
        cursor: pointer;
    }
    .badgeDelete:hover{
        cursor: pointer;
    }
</style>
@endpush
@push('afterScripts')
<script>
    $(function(){
        $('.badgeLihat').on('click', function(){
            var link = $(this).data('link');
            $('#modalLihatBukti .imgModalBukti').attr('src',link);
            $('#modalLihatBukti').modal('show');
        })
        $('.badgeDelete').on('click', function(){
            $('#formDeleteBukti').submit();
        })
        $('body').on('click','.btnAddRating', function(){
            var product_id = $(this).data('productid');
            $('#product_id_rating').val(product_id);
            $('#modalAddRating').modal('show');
        })
    })
</script>
@endpush
