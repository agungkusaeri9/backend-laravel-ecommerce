@extends('admin.templates.default')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @include('admin.templates.partials.alert')
        <div class="card">
            <div class="card-header">
                <h6 class="text-dark text-center font-weight-bold">Profil Saya</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-5">
                    <img src="{{ $user->avatar() }}" alt="" class="img-fluid text-center" style="max-width: 200px;max-height:250px">
                </div>

                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Hp</td>
                        <td>{{ $user->phone_number }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td>Bergabung</td>
                        <td>{{ $user->created_at->translatedFormat('d/m/Y') }}</td>
                    </tr>
                </table>

                <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-info float-right"><i class="fas fa-edit"></i> Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection