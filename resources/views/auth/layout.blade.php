<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>@yield('title', 'Login')</title>
    <link rel="icon" type="image/png" href="assets/images/logo/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/rt-plugins.css">
    <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}">
    <!-- START : Theme Config js-->
    <script src="{{ asset('backend/assets/js/settings.js') }}" sync></script>
    <!-- END : Theme Config js-->

    <style>
        .dark_logo{
            width:250px;
            text-align:center;

        }
        .mobile-logo{
            align-self: center;

        }
        </style>
</head>

<body class=" font-inter skin-default">

    <div class="loginwrapper">
        <div class="lg-inner-column">
            @yield('content')
        </div>
    </div>

    <!-- scripts -->
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/rt-plugins.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    @include('scripts.izitoast')
</body>

</html>
