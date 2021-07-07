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
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>#UUID</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Transaction Total</th>
                                    <th>Transaction Status</th>
                                </tr>
                            </thead>
                            {{-- <tbody> --}}
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <a href="{{ route('transactions.show', $transaction->id) }}" class="uuid text-dark" >{{ $transaction->uuid }}</a>
                                        </td>
                                        <td>{{ $transaction->name }}</td>
                                        <td>{{ $transaction->phone_number }}</td>
                                        <td>{{ $transaction->address }}</td>
                                        <td>Rp. {{ number_format($transaction->transaction_total) }}</td>
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
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Tidak Ada
                                    </td>
                                </tr>
                                @endforelse
                            {{-- </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('afterStyles')
<style>
    a.uuid:hover{
        color: black;
    }
</style>
@endpush
