<script src="{{ asset('assets/frontend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/aos.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script>  
$(".carousel").carousel({
  interval: 4500,
});

AOS.init({
  duration : 800
})
</script>