<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        window.tailwind = window.tailwind || {};
        window.tailwind.config = {
            corePlugins: {
                preflight: false
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('front/css/style.css?v=20260722-6') }}">
    @stack('css')
</head>
<body class="home-page">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="top-bar">
    <div class="container">
        <div class="top-info">
            <a href="tel:+13054133603"><i class="fas fa-phone-alt"></i>+1 305 413 36 03</a>
            <a href="mailto:erdoor@erdoor.us"><i class="fas fa-envelope"></i> erdoor@erdoor.us</a>
        </div>
        <div class="top-social">
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

@include('front.layouts.header')


@yield('content')

@include('front.layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('front/js/main.js') }}"></script>
@stack('js')

</body>
</html>
