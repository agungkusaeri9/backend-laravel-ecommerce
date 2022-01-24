<!DOCTYPE html>
<html lang="id">

<head>
    @include('user.templates.partials.head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('user.templates.partials.header')
    <!-- Header End -->

    <div style="min-height:600px">
        @yield('content')
    </div>

    <!-- Footer Section Begin -->
    @include('user.templates.partials.footer')
    <!-- Footer Section End -->
    
    @include('user.templates.partials.scripts')
</body>

</html>