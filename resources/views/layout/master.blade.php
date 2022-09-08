<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Favicons -->
    <link href="{{ asset('asset/img/favicon.ico') }}" rel="icon">
    <link href="{{ asset('asset/img/favicon.ico') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('asset/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('asset/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('asset/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <style>
        #header {
            background: rgba(0, 0, 0, 1) !important;
            padding: 15px 0 !important;
            height: 92px !important;
            transition: all 0.5s !important;
        }
    </style>

    @yield('head')
</head>

<body>
    <x-layout.header></x-layout.header>
    <div style='padding-top:110px; padding-bottom:30px;'>
        <section id="breadcrumb" class="wow fadeIn my-4">
            <div class="container">
                <header class="section-header">
                    <h3>{{ $title ?? 'Page Title' }}</h3>
                </header>
            </div>
            <div class="text-center">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="/">Beranda</a></li>
                    <?php $segments = ''; ?>
                    @foreach (Request::segments() as $segment)
                        <?php $segments .= '/' . $segment; ?>
                        <li class="list-inline-item">
                            <a href="#">{{ ucwords(str_replace('-', ' ', $segment)) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <div class="container">
            @yield('main')
        </div>
    </div>

    <x-preloader />
    <x-layout.footer />

    <!-- JavaScript Libraries -->
    <script src="{{ asset('asset/lib/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('asset/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('asset/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/lib/touchSwipe/jquery.touchSwipe.min.js') }}"></script>
    @yield('script')

    <!-- Template Main Javascript File -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
</body>

</html>
