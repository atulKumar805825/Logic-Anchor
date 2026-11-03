<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard')</title>

    <!--<link rel="icon" type="image/png" href="{{ asset('backend/assets/images/logo/favicon.svg') }}">-->
    
        <link rel="icon" type="image/png" href="{{ asset('backend/assets/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('backend/assets/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('backend/assets/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/apple-touch-icon.png') }}" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}">

</head>

<body class="font-inter dashcode-app" id="body_class">
    <main class="app-wrapper">
        @include('layouts.user.partials.sidebar')
        <div class="flex flex-col justify-between min-h-screen">
            <div>
                @include('layouts.user.partials.header')
                <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]"
                    id="content_wrapper">
                    <div class="page-content">
                        <div class="transition-all duration-150 container-fluid" id="page_layout">
                            <div id="content_layout">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.user.partials.footer')
        </div>
    </main>

    <!-- scripts -->
    <script src="{{ asset('backend/assets/js/settings.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/rt-plugins.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
     @include('scripts.izitoast')
</body>

</html>
