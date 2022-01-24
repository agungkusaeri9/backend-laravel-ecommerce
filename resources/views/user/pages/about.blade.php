@extends('user.templates.default')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center page-title" style="font-size: 18px">About Us</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $item->desc !!}
        </div>
    </div>
</div>
@endsection