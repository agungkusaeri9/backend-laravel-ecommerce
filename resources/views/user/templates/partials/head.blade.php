<meta charset="UTF-8" />
<meta name="description" content="{{ $store->meta_description ?? 'Nita Store' }}" />
<meta name="keywords" content="{{ $store->meta_keyword ?? 'Toko Online, online shop, belanja' }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>{{ $title ?? 'Putri Store' }}</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Antic+Slab&family=Righteous&family=Staatliches&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

 <!-- Custom fonts for this template-->
<link href="{{ asset('assets/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<!-- Css Styles -->
<link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/font-awesome.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/themify-icons.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/elegant-icons.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/owl.carousel.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/nice-select.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/jquery-ui.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/slicknav.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/user/css/custom.css') }}" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stack('afterStyles')
