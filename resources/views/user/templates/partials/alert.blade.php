@push('afterStyles')
<link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
@endpush
@push('afterScripts')
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
@if (session('success'))
<script>
    toastr.success('{{ session('success') }}.')
</script>
@endif
@if (session('error'))
<script>
    toastr.error('{{ session('error') }}.')
</script>
@endif
@endpush
