{{-- @if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif --}}
@if (session('success') || session('error'))
    @push('afterStyles')
        <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
    @endpush
    @push('afterScripts')
        <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
        @if (session('success'))
            <script>
                toastr.success('{{ session('success') }}')
            </script>
        @endif
        @if (session('error'))
            <script>
                toastr.error('{{ session('error') }}')
            </script>
        @endif
    @endpush
@endif

