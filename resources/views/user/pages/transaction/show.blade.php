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
                                        </tr>
                                        @foreach ($transaction->details as $detail)
                                        <tr>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ $detail->amount }}</td>
                                            <td>{{ number_format($detail->product->price) }}</td>
                                            <td>{{ number_format($detail->product->price * $detail->amount) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-center font-weight-bold" colspan="2">Total</td>
                                            <td colspan="2" class="text-center font-weight-bold">Rp. {{ number_format($price_total) }}</td>
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
    })
</script>
@endpush
