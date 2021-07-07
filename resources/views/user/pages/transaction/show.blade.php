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
                        <table class="table table-bordered">
                            <tr>
                                <th>UUID</th>
                                <td>{{ $transaction->uuid }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $transaction->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $transaction->email }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $transaction->address }}</td>
                            </tr>
                            <tr>
                                <th>Product</th>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Price Total</th>
                                        </tr>
                                        @foreach ($transaction->details as $detail)
                                        <tr>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ $detail->amount }}</td>
                                            <td>Rp. {{ number_format($detail->product->price) }}</td>
                                            <td>Rp. {{ number_format($detail->product->price * $detail->amount) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-center font-weight-bold" colspan="3">Total</td>
                                            <td>Rp. {{ number_format($price_total) }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>Payment</th>
                                <td>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $payment->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Number</th>
                                            <td>{{ $payment->number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Desc</th>
                                            <td>{{ $payment->desc }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>Courier</th>
                                <td>{{ $transaction->courier }}</td>
                            </tr>
                            <tr>
                                <th>Receipt Number</th>
                                <td>{{ $transaction->receipt_number }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Cost</th>
                                <td>Rp. {{ number_format($transaction->shipping_cost) }}</td>
                            </tr>
                            <tr>
                                <th>Total Pay</th>
                                <td>Rp. {{ number_format($transaction->transaction_total) }}</td>
                            </tr>
                            <tr>
                                <th>Proof Of Payment</th>
                                <td>
                                    @if ($transaction->proof_of_payment !== NULL)
                                    <span class="badge badge-success">Has been uploaded</span>
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
          <h5 class="modal-title" id="exampleModalLabel">Upload Proof Of Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('transactions.upload-proof') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input type="hidden" value="{{ $transaction->uuid }}" name="uuid">
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
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
@endsection