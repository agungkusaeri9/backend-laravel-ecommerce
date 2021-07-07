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
                        <table class="table table-borderless">
                            <tr>
                                <td colspan="2" class="text-center mb-2">
                                    <img src="{{ auth()->user()->avatar() }}" alt="{{ auth()->user()->name }}" class="img-fluid rounded-circle" style="height: 150px;width:150px;">
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ auth()->user()->username }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ auth()->user()->gender }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ auth()->user()->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ auth()->user()->address }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modalEditAccount"><i class="fas fa-edit"></i> Edit</a>
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
<div class="modal fade" id="modalEditAccount" tabindex="-1" aria-labelledby="modalEditAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditAccountLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('account.update') }}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" readonly value="{{ auth()->user()->username }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}"readonly>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" value="{{ auth()->user()->phone_number }}">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="laki-laki" value="laki-laki" @if(auth()->user()->gender === 'laki-laki') checked @endif>
                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="perempuan" value="perempuan" @if(auth()->user()->gender === 'perempuan') checked @endif>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="addredd">Address</label>
                    <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ auth()->user()->address }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection