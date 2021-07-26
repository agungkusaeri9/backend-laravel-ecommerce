@extends('admin.templates.default')
@section('content')
@if (session('success'))
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Profil Saya</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-5">
                    <img src="{{ $user->avatar() }}" alt="" class="img-fluid text-center" style="max-width: 200px;max-height:250px">
                </div>

                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Hp</th>
                        <td>{{ $user->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Bergabung</th>
                        <td>{{ $user->created_at->translatedFormat('d/m/Y') }}</td>
                    </tr>
                </table>

                <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-info float-right"><i class="fas fa-edit"></i> Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection