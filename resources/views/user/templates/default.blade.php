<!doctype html>
<html lang="en">
  <head>
    @include('user.templates.partials.head')
  </head>
  <body>

    <div id="app">

         <!-- navbar -->
        @include('user.templates.partials.navbar')
        <!-- end navbar -->

        <!-- content -->
        <div class="container mt-3 mb-5" style="min-height:500px;">
            @yield('content')
        </div>
        <!-- akhir content -->


        <!-- footer -->
        @include('user.templates.partials.footer')
        <!-- footer -->

    </div>

    @include('user.templates.partials.scripts')
  </body>
</html>