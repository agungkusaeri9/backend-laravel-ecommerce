@if (session('success'))
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
                Sukses Terbayar!
            </h3>
            <p class="mt-2">
                {{ session('success') }}
            </p>
            <a href="{{ route('home') }}" class="primary-btn pd-cart mt-3">Back to Home</a>
        </div>
    </div>
    
    @include('user.templates.partials.scripts')
</body>

</html>
@endif