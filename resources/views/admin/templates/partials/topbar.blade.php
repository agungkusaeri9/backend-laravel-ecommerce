<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        {{-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">
                    @if ($notifications_count > 9)
                    {{ $notifications_count }}+
                    @else
                    {{ $notifications_count }}
                    @endif
                </span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Pemberitahuan
                </h6>
                @forelse ($notifications as $notification)
                <a class="dropdown-item py-3 d-flex align-items-center itemNotif" data-id="{{ $notification->id }}" href="javascript:void(0)">
                    <div class="mr-3">
                        <div class="icon-circle">
                            <img src="{{ $notification->user->avatar() }}"  alt="" class="img-fluid rounded-circle" style="max-height: 45px;max-width:45px">
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ $notification->created_at->translatedFormat('l, d F Y H:i:s') }}</div>
                        <span class="font-weight-bold">
                            {{ $notification->user->name . ' telah melakukan ' . $notification->name }}
                        </span>
                    </div>
                </a>
                @empty
                <div class="text-center small mt-3 py-3">Tidak Ada Pemberitahuan Terbaru</div>
                @endforelse
                <a class="dropdown-item text-center small text-gray-500" href="#">Lihat Semua Pemberitahuan</a>
            </div>
        </li> --}}

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Str::ucfirst(auth()->user()->name) }}</span>
                <img class="img-profile rounded-circle"
                    src="{{ auth()->user()->avatar() }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>
@push('afterScripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(function(){
        $('body').on('click', '.itemNotif', function(){
            var id = $(this).data('id');
            $.ajax({
                url:'{{ route('admin.notifications.update') }}',
                type:'POST',
                dataType: 'JSON',
                data: {
                    id
                },
                success: function(res){
                    window.location.reload();
                }
            })
        })
    })
</script>
@endpush
