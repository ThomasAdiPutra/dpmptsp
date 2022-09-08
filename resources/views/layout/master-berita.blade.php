<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

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
    @yield('css')

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
</head>

<body>
    <x-layout.header></x-layout.header>
    <div class="container-fluid px-0" style='padding-top:110px; padding-bottom:30px;'>
        <section id="breadcrumb" class="wow fadeIn my-4">
            <div class="container">
                <header class="section-header">
                    <h3>{{ $title }}</h3>
                </header>
            </div>
            <div class="text-center">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="/">Beranda</a></li>
                    <li class="list-inline-item">
                        <a href="{{ route('berita.index') }}">Berita</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">{{ Str::words($title, 5) }}</a>
                    </li>
                </ul>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 pb-5">@yield('main')</div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <form action="{{ route('berita.index') }}">
                        <div class="form-row align-items-center">
                            <div class="col-auto" style="width: 100%">
                                <label class="sr-only" for="search">Search...</label>
                                <div class="input-group mb-2">
                                    <input type="search" name="q" class="form-control" id="search" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary mb-2"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mb-3 latest-news">
                        <x-news.latest-news />
                    </div>
                    <div class="related-news">
                        <div class="card">
                            <div class="card-header p-2">
                                <div class="card-title m-0">Berita Terkait</div>
                            </div>
                            <div class="card-body py-2 px-2">
                                @foreach ($relatedNews as $news)
                                    <x-news.card title="{{ $news->title }}" image="{{ $news->thumbnail }}"
                                        date="{{ $news->created_at }}" slug="{{ $news->slug }}"/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-preloader/>
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
