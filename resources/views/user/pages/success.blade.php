@if (session('transaction_uuid'))
<!DOCTYPE html>
<html lang="id">

<head>
    @include('user.templates.partials.head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="d-flex success-checkout align-items-center justify-content-center">
        <div class="col col-lg-4 text-center">
            <img src="{{ asset('assets/user/img/success-buy.png') }}" alt="" style="max-height:250">
            <h3 class="mt-4">
                Success!
            </h3>
            <p class="mt-2">
                Silahkan lakukan pembayaran dan jangan lupa upload bukti pembayarannya agar cepat diproses.
            </p>
            <a href="{{ route('transactions.show', session('transaction_uuid')) }}" class="primary-btn pd-cart mt-3">Kembali Ke Pesanan</a>
        </div>
    </div>
    
    @include('user.templates.partials.scripts')
</body>

</html>
@else 
tidak ada
@endif