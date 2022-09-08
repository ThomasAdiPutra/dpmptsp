<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Website Resmi DPMPTSP Ketapang') }}</title>

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
    <link href="{{ asset('asset/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">

    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/index.css') }}">
    <style>
        .slick-track {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .slick-slide {
            height: inherit !important;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
            font-size: 30px;
        }

        .slick-prev {
            left: -35px !important;
        }

        .news-item {
            height: 100%;
        }

        .news-carousel>.slick-list>.slick-track {
            display: flex !important;
            align-items: stretch !important;
        }
    </style>
</head>

<body>
    <x-layout.header></x-layout.header>

    <!--==========================
      Intro Section
    ============================-->
    <section id="intro">
        <div class="intro-container">
            <div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators"></ol>
                <div class="carousel-inner" role="listbox">
                    @foreach ($carousels as $carousel)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="carousel-background">
                                <img src='{{ asset(str_replace('\\', '/', $carousel->path)) }}' alt="">
                            </div>
                            <div class="carousel-container">
                                <div class="carousel-content">
                                    <h2>Selamat datang di</h2>
                                    <h2>DPMPTSP Kabupaten Ketapang</h2>
                                    <a href="#featured-services" class="btn-get-started scrollto">Get Started</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- #intro -->

    <main id="main">
        <!--==========================
          Featured Services Section
        ============================-->
        <section id="featured-services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 box">
                        <i class="ion-ios-bookmarks-outline"></i>
                        <h4 class="title"><a href="">Profesional</a></h4>
                        <p class="description">Memberikan pelayanan berkualitas oleh ahilnya sesuai dengan standar
                            pelayanan</p>
                    </div>

                    <div class="col-lg-4 box box-bg">
                        <i class="ion-ios-stopwatch-outline"></i>
                        <h4 class="title"><a href="">Cepat</a></h4>
                        <p class="description">Menyelesaikan proses perizinan dengan tepat waktu</p>
                    </div>

                    <div class="col-lg-4 box">
                        <i class="ion-ios-heart-outline"></i>
                        <h4 class="title"><a href="">Ramah</a></h4>
                        <p class="description">Sopan santun dalam memberikan pelayanan</p>
                    </div>

                </div>
            </div>
        </section><!-- #featured-services -->

        <!--==========================
          About Us Section
        ============================-->
        <section id="about">
            <div class="container">
                <header class="section-header">
                    <h3>Tentang Kami</h3><br>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p> --}}
                </header>

                <div class="row about-cols">
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-col">
                            <div class="img">
                                <img src="{{ asset('asset/img/about-tugas-pokok.png') }}" alt="" height="200px"
                                    width="100%">
                                <div class="icon"><i class="ion-ios-eye-outline"></i></div>
                            </div>
                            <h2 class="title"><a href="#">Tugas Pokok</a></h2>
                            <p>
                                {{ $abouts['tugas_pokok']->value }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="about-col">
                            <div class="img">
                                <img src="{{ asset('asset/img/about-maklumat.jpg') }}" alt="" width="100%"
                                    height="200px">
                                <div class="icon"><i class="ion-ios-list-outline"></i></div>
                            </div>
                            <h2 class="title"><a href="#">Maklumat Pelayanan</a></h2>
                            <p>
                                {{ $abouts['maklumat_pelayanan']->value }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-col">
                            <div class="img">
                                <img src="{{ asset('asset/img/about-vision.jpg') }}" alt=""
                                    style="height:200px;" width="100%">
                                <div class="icon"><i class="ion-ios-eye-outline"></i></div>
                            </div>
                            <h2 class="title"><a href="#">Visi</a></h2>
                            <p>
                                {{ $abouts['visi']->value }}
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- #about -->

        <!--==========================
          Team Section
        ============================-->
        <section id="team">
            <div class="container">
                <div class="section-header wow fadeInUp">
                    <h3>Perangkat DPMPTSP</h3>
                </div>

                <div class="perangkat-dpmptsp">
                    @foreach ($team as $member)
                        <div class="member px-2" style="background-color: white">
                            <img src="{{ $member->image }}" class="img-fluid" alt="{{ $member->name }}">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>{{ $member->name }}</h4>
                                    <span>{{ $member->job_title }}</span>
                                    <div class="social">
                                        @if ($member->facebook != '')
                                            <a href="{{ $member->facebook }}"><i class="fa fa-facebook"></i></a>
                                        @endif
                                        @if ($member->instagram != '')
                                            <a href="{{ $member->instagram }}"><i class="fa fa-instagram"></i></a>
                                        @endif
                                        @if ($member->twitter != '')
                                            <a href="{{ $member->twitter }}"><i class="fa fa-twitter"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- #team -->

        <!--==========================
          Services Section
        ============================-->
        <section id="services">
            <div class="container">
                <header class="section-header wow fadeInUp">
                    <h3>Layanan</h3>
                </header>

                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
                            <div class="icon"><i
                                    class="{{ $service->icon != 0 ? 'fa ' . $service->icon : 'ion-ios-analytics-outline' }}"></i>
                            </div>
                            <h4 class="title"><a
                                    href="{{ url('layanan/' . str_replace(' ', '-', $service->name)) }}">{{ $service->name }}</a>
                            </h4>
                            <p class="description">{{ $service->description }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </section><!-- #services -->

        <!--==========================
          Agenda Section
        ============================-->
        <section id="timeline" class="wow fadeIn">
            <div class="container text-center">
                <h3>Agenda</h3>
                <div class="timeline">
                    <ol>
                        @foreach ($agendas as $agenda)
                            <li>
                                <div>
                                    <time> {{ date('d M Y', strtotime($agenda->start_date)) }} @if ($agenda->start_date !== $agenda->end_date)
                                            - {{ date('d M Y', strtotime($agenda->end_date)) }}
                                        @endif
                                    </time>

                                    <span class='d-flex text-justify'>
                                        @foreach (explode('~', $agenda->title) as $title)
                                            {{ $title }} @if ($loop->iteration < $loop->count && $loop->count > 1)
                                                <br>
                                            @endif
                                        @endforeach
                                    </span>
                                    {{-- {{ $agenda->title }} --}}
                                </div>
                            </li>
                        @endforeach
                        <li></li>
                    </ol>
                </div>
                <a href="{{ url('/agenda') }}" class="btn btn-success rounded-pill px-5 py-3 mt-2">Lihat
                    Selengkapnya</a>
            </div>
        </section><!-- #Agenda-action -->

        <!--==========================
          News Section
        ============================-->
        <section id="news">
            <div class="container py-5">
                <div class="section-header wow fadeInUp">
                    <h3>Berita Terbaru</h3>
                </div>

                <div class="news-carousel">
                    @foreach ($latestNews as $news)
                        <div class="card mx-2 news-item pb-4 mb-1">
                            <img src="{{ $news->thumbnail }}" alt="" class="card-img-top" height="200"
                                width="100%">
                            <div class="card-body" style="height:100%;">
                                <div class="card-title mb-2">
                                    <strong>{{ $news->title }}</strong>
                                    <div class="text-muted">
                                        <small>{{ date('d M', strtotime($news->created_at)) }}</small>
                                    </div>
                                </div>
                                <div class="card-text pb-3">{!! Str::words($news->content, 8) !!}</div>
                                <div style="position: absolute; bottom:0; width:100%" class="mb-2 pb-2 pr-5">
                                    <a href="{{ route('berita.show', ['beritum' => $news->slug]) }}"
                                        class="btn btn-outline-success btn-sm">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card mx-2 border p-2">
                            <img class="card-img-top" src="{{ $news->thumbnail }}" alt="{{ $news->title }}"
                                height="250px">
                            <div class="card-body p-0 pt-2">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body p-0 text-center py-1">
                                                {{ date('d', strtotime($news->created_at)) }}</div>
                                            <div class="card-footer p-0 text-center">
                                                {{ date('M', strtotime($news->created_at)) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="card-title">{{ $news->title }}</h5>
                                    </div>
                                </div>
                                <p class="card-text">{{ Str::words($news->content, 8) }}</p>
                                <a href="{{ route('berita.show', ['beritum' => Str::slug($news->title)]) }}"
                                    class="btn btn-primary">Baca selengkapnya</a>
                            </div>
                        </div> --}}
                    @endforeach
                </div>
            </div>
        </section>

        <!--==========================
          Statistic Section
        ============================-->
        <section id="statistic" class="wow fadeIn">
            <div class="container">
                <header class="section-header">
                    <h3>Statistik</h3>
                </header>
                <div class="row counters">
                    <div class="col-4 text-center">
                        <i class="fa fa-file-text-o fa-3x" style="color: #18d26e"></i>
                        <span data-toggle="counter-up">{{ $statistic['services'] }}</span>
                        <p>Layanan</p>
                    </div>

                    <div class="col-4 text-center">
                        <i class="fa fa-users fa-3x" style="color: #18d26e"></i>
                        <span data-toggle="counter-up">{{ $statistic['visit'] }}</span>
                        <p>Pengunjung</p>
                    </div>

                    <div class="col-4 text-center">
                        <i class="fa fa-warning fa-3x" style="color: #18d26e"></i>
                        <span data-toggle="counter-up">{{ $statistic['complaint'] }}</span>
                        <p>Aduan</p>
                    </div>
                </div>
            </div>
        </section><!-- #facts -->

        <!--==========================
          gallery Section
        ============================-->
        <section id="gallery" class="section-bg">
            <div class="container text-center">
                <header class="section-header">
                    <h3 class="section-title">Galeri</h3>
                </header>

                <div class="row">
                    @foreach ($galleries as $gallery)
                        <div class="col-lg-3 col-md-6 gallery-item wow fadeInUp my-2">
                            <figure>
                                <img src="{{ $gallery->path }}" width="100%" height="200px" alt="">
                                <a href="{{ $gallery->path }}" data-lightbox="gallery"
                                    data-title="{{ $gallery->title }}" class="link-preview" title="Preview"><i
                                        class="ion ion-eye"></i></a>
                            </figure>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('galeri.index') }}" class="btn btn-success rounded-pill px-5 py-3 mt-3">Lihat
                    Selengkapnya</a>
            </div>
        </section>
        <!-- #gallery -->

        <!--==========================
            Contact Section
        ============================-->
        <section id="call-to-action" class="wow fadeIn">
            <div class="container text-center">
                <h3>Hubungi Kami</h3>
                <p> Punya pertanyaan seputar DPMPTSP Ketapang atau pertanyaan terkait perizinan? </p>
                <a class="cta-btn" target="_BLANK" href="https://wa.me/{{ $whatsapp }}"><i class="fa fa-whatsapp pr-2"></i>Whatsapp</a>
            </div>
        </section>

        <!--==========================
          Related Links Section
        ============================-->
        <section id="related-links">
            <div class="container text-center py-4">
                <h1>Link Terkait</h1>
                <div class="related-links py-2">
                    @foreach ($relatedLinks as $relatedLink)
                        <a href="{{ $relatedLink->link }}" class="overflow-hidden mx-auto px-2">
                            <img src="{{ $relatedLink->logo }}" alt="{{ $relatedLink->name }}"
                                class="img-fluid center" width="200px" height="100px"
                                title="{{ $relatedLink->name }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!--==========================
          Announcement Section
        ============================-->
        <x-announcement></x-announcement>
    </main>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <a href="#" class="announcement-btn"><i class="fa fa-bullhorn"></i></a>
    <x-preloader />

    <x-layout.footer />

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('asset/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('asset/lib/superfish/hoverIntent.js') }}"></script>
    <script src="{{ asset('asset/lib/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('asset/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('asset/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('asset/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('asset/lib/touchSwipe/jquery.touchSwipe.min.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Template Main Javascript File -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
    <script src="{{ asset('asset/js/index.js') }}"></script>
    <script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
    <script src="{{ asset('asset/js/timeline.js') }}"></script>
    <script>
        @if (!$announcements->isEmpty())
            $('#announcement').modal('show')
            $('#announcement-item').slick({
                infinite: true,
                slidesToShow: 1,
            });
        @endif

        $('.perangkat-dpmptsp').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: false,
            prevArrow: false,
            nextArrow: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }, ]
        });

        $('.related-links').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: false,
            prevArrow: false,
            nextArrow: false,
            responsive: [{
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.news-carousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: false,
            prevArrow: false,
            nextArrow: false,
            responsive: [{
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
</body>

</html>
