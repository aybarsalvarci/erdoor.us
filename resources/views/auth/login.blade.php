<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template">

    <title>Admin Login | {{ $settings->title ?? 'ERDOOR' }}</title>

    <!-- color-modes:js -->
    <script src="{{ asset('back/assets/js/color-modes.js') }}"></script>
    <!-- endinject -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('back/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('back/assets/css/demo1/style.css') }}">
    <!-- End layout styles -->

    <!-- Dinamik Favicon -->
    <link rel="shortcut icon" href="{{ asset($settings->favicon ?? 'back/assets/images/favicon.png') }}"/>
</head>
<body>
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content container-xxl d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper" style="
                                    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('{{ asset('front/assets/images/login-bg.jpg') }}');
                                    background-size: cover;
                                    background-position: center;
                                    border-top-left-radius: 0.375rem;
                                    border-bottom-left-radius: 0.375rem;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                    justify-content: center;
                                    padding: 2rem;
                                    min-height: 100%;
                                ">
                                    <div class="text-center text-white">
                                        <h3 class="fw-bold mb-2">ERDOOR</h3>
                                        <p class="text-white-50 small mb-4">Management & Control System</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="nobleui-logo d-block mb-2">ER<span>DOOR</span></a>
                                    <h5 class="text-secondary fw-normal mb-4">Welcome back! Log in to your account.</h5>

                                    <!-- Genel Hata Mesajı (Giriş başarısız vb.) -->
                                    @if(session('error'))
                                        <div class="alert alert-danger mb-3" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form class="forms-sample" action="{{ route('login') }}" method="POST">
                                        @csrf

                                        <!-- Email Alanı -->
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email address</label>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="userEmail"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   placeholder="Email"
                                                   required
                                                   autofocus>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Şifre Alanı -->
                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Password</label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="userPassword"
                                                   name="password"
                                                   autocomplete="current-password"
                                                   placeholder="Password"
                                                   required>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Beni Hatırla -->
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="authCheck"
                                                       name="remember">
                                                <label class="form-check-label" for="authCheck">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <button type="submit"
                                                    class="btn btn-primary btn-block me-2 mb-2 mb-md-0 w-100">Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- core:js -->
<script src="{{ asset('back/assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- inject:js -->
<script src="{{ asset('back/assets/js/app.js') }}"></script>

</body>
</html>
