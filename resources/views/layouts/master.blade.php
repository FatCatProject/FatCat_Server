<!DOCTYPE HTML>
<html>
<head>
    <title>FatCat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="FatCat" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @include('layouts.styling')

    <script>
        new WOW().init();
    </script>
</head>

<body class="sticky-header left-side-collapsed" onload="initMap()">
<section>

 @include('layouts/menu')

    <!-- main content start-->
    <div class="main-content">
        <!-- header-starts -->
        @include('layouts/header')
        <!-- //header-ends -->

        <!-- //content starts -->
        @yield('content')
        <!-- //content ends -->
        <!--body wrapper end-->
    </div>

    <!--footer section start-->
    @include('layouts/footer')
    <!--footer section end-->

    <!-- main content end-->
</section>

<script src="/js/jquery.nicescroll.js"></script>
<script src="/js/scripts.js"></script>

</body>
</html>