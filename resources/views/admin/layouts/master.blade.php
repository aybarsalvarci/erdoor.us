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

    <link rel="stylesheet" href="{{asset('back/assets/vendors/sweetalert2/sweetalert2.min.css')}}">

    <!-- SweetAlert Bildirimleri -->
    <style>
        .swal-custom-toast {
            background-color: #1e293b !important; /* Arkaplandan ayrışan daha açık ve tok bir lacivert/gri */
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-left: 5px solid #10b981 !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.6) !important;
        }

        .swal-custom-toast .swal2-title {
            color: #f8fafc !important;
        / font-size: 16 px !important;
            font-weight: 600 !important;
        }

        .swal-custom-toast .swal2-html-container {
            color: #94a3b8 !important;
            font-size: 14px !important;
        }

        .swal-custom-toast .swal2-timer-progress-bar {
            background-color: #10b981 !important;
        }

        .swal-custom-modal {
            background-color: #1e293b !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-top: 5px solid #ef4444 !important;
            border-radius: 12px !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.7) !important;
        }

        .swal-custom-modal .swal2-title {
            color: #f8fafc !important;
        }

        .swal-custom-modal .swal2-html-container {
            color: #94a3b8 !important;
            font-size: 15px !important;
        }
    </style>

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

<script src="{{asset('back/assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Ortak SweetAlert Bildirimleri -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        @if(session()->has('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Başarılı!',
            text: {!! json_encode(session('success')) !!},
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            iconColor: '#10b981',
            customClass: {
                popup: 'swal-custom-toast',
                container: 'mt-3 me-2'
            }
        });
        @endif

        @if(session()->has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Hata Oluştu!',
            text: {!! json_encode(session('error')) !!},
            showConfirmButton: true,
            confirmButtonText: 'Tamam',
            buttonsStyling: false,
            iconColor: '#ef4444',
            customClass: {
                popup: 'swal-custom-modal',
                confirmButton: 'btn btn-danger px-4 fw-bold'
            }
        });
        @endif

    });
</script>

@stack('js')
</body>

</html>
