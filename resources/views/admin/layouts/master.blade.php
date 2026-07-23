<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

    <!-- color-modes:js -->
    <script src="{{asset('back/assets/js/color-modes.js')}}"></script>
    <!-- endinject -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('back/assets/vendors/core/core.css')}}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{asset('back/assets/css/demo1/style.css')}}">

    @stack('css')

    <link rel="shortcut icon" href="{{asset('back/assets/images/favicon.png')}}"/>
</head>

<body>
<div class="main-wrapper">

    <!-- Sidebar Start-->
    @include('admin.layouts.sidebar')
    <!-- Sidebar End -->

    <div class="page-wrapper">

        <!-- Navbar Start -->
        @include('admin.layouts.navbar')
        <!-- Navbar End -->

        <div class="page-content container-xxl">
            @yield('content')
        </div>

        <!-- Footer Start -->
        @include('admin.layouts.footer')
        <!-- Footer End -->

    </div>
</div>

<!-- core:js -->
<script src="{{asset('back/assets/vendors/core/core.js')}}"></script>
<!-- endinject -->

<!-- inject:js -->
<script src="{{asset('back/assets/js/app.js')}}"></script>
<!-- endinject -->

<!-- Page Js -->
@stack('js')
</body>

</html>
