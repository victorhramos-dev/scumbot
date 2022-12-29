<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-textdirection="ltr">
<head>
    <title>@yield('title') - {{ config('app.name') }}</title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{ config('app.url') }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- Fixed CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/admin-dashboard.css')) }}">

    <!-- Dinamic CSS Files -->
    @stack('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        @foreach($errors->getMessages() as $error)
                            <div class="alert alert-danger mb-2" role="alert">
                                <h4 class="alert-heading">Atenção</h4>
                                <div class="alert-body">{{ $error[0] }}</div>
                            </div>
                        @endforeach

                        @if(session('status'))
                            <div class="alert alert-danger mb-2" role="alert">
                                <h4 class="alert-heading">Atenção</h4>
                                <div class="alert-body">{{ session('status') }}</div>
                            </div>
                        @endif

                        <div class="card mb-0">
                            <div class="card-body">
                                <span class="brand-logo">
                                    <img src="{{ asset('img/logo-white.png') }}" class="img-responsive">
                                </span>

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset(mix('js/main.js')) }}"></script>

    @stack('scripts')

    <style type="text/css">
        .brand-logo img {
            max-width: 60%;
        }

        html, body {
            background-color: #f4f4f4;
        }

        .auth-wrapper.auth-v1 .auth-inner .card {
            background-color: #ED1C24;
        }

        .auth-wrapper.auth-v1 .auth-inner .card .form-group label {
            color: #ffffff !important;
        }

        .block-forgot {
            margin-top: -10px;
            text-align: right;
            margin-bottom: 2em;
        }
    </style>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width  : 14,
                    height : 14
                });
            }
        })
    </script>
</body>
</html>