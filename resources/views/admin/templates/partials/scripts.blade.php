<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/sbadmin2/js/sb-admin-2.min.js') }}"></script>
<script>
    let w = window.matchMedia("(max-width: 500px)");
        if(w.matches){
            $('#page-top').addClass('sidebar-toggled');
            $('.sidebar').addClass('toggled');
        }
</script>
@stack('afterScripts')