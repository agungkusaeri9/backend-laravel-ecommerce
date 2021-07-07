@if (session('transaction_id'))
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
            <img src="{{ asset('assets/user/img/success-buy.png') }}" alt="" width="294">
            <h3 class="mt-4">
                Success!
            </h3>
            <p class="mt-2">
                Please check your email or whatsapp number for payment information and upload proof of payment in the transactions menu
            </p>
            <a href="{{ route('transactions.show', session('transaction_id')) }}" class="primary-btn pd-cart mt-3">Back to Transactions</a>
        </div>
    </div>
    
    @include('user.templates.partials.scripts')
</body>

</html>
@endif