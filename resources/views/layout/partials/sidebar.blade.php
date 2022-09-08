<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ auth()->user()->image }}" alt="user-img" title="Mat Helme"
                class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"
                    aria-expanded="false">{{ auth()->user()->name }}</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                        <i class="fa fa-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                        <i class="fa fa-sign-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>

            <p class="text-muted left-user-info">{{ auth()->user()->job_title }}</p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{ route('profile') }}" class="text-muted left-user-info">
                        <i class="fa fa-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{ route('logout') }}">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-tachometer"></i>
                        {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile') }}">
                        <i class="fa fa-user"></i>
                        <span> Profil </span>
                    </a>
                </li>

                <!-- Agenda -->
                @can('agenda')
                    <li>
                        <a href="{{ route('agenda.all') }}">
                            <i class="fa fa-calendar"></i>
                            <span> Agenda </span>
                        </a>
                    </li>
                @endcan

                <!-- Berita -->
                @can('berita')
                    <li>
                        <a href="#infoTerkini" data-bs-toggle="collapse">
                            <i class="fa fa-info-circle"></i>
                            <span> Info Terkini </span>
                            <span class="fa fa-angle-right"></span>
                        </a>
                        <div class="collapse" id="infoTerkini">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('berita.all') }}">
                                        <i class="fa fa-newspaper-o"></i>
                                        <span> Berita </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('kategori.index') }}">
                                        <i class="fa fa-list"></i>
                                        <span> Kategori </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                <!-- Galeri -->
                @can('galeri')
                    <li>
                        <a href="{{ route('galeri.all') }}">
                            <i class="fa fa-picture-o"></i>
                            <span> Galeri </span>
                        </a>
                    </li>
                @endcan

                <!-- Interaksi Masyarakat -->
                @canany(['pengaduan', 'skm'])
                    <li>
                        <a href="#sidebarAuth" data-bs-toggle="collapse">
                            <i class="fa fa-user-plus"></i>
                            <span> Interaksi Masyarakat </span>
                            <span class="fa fa-angle-right"></span>
                        </a>
                        <div class="collapse" id="sidebarAuth">
                            <ul class="nav-second-level">
                                @can('pengaduan')
                                    <li>
                                        <a href="{{ route('pengaduan.all') }}">
                                            <i class="fa fa-exclamation-triangle pe-1"></i>
                                            <span> Pengaduan </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('skm')
                                    <li>
                                        <a href="{{ route('skm.all') }}">
                                            <i class="pe-1 fa fa-line-chart"></i>
                                            <span>Survey Kepuasan Masyarakat</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('indikator.index') }}">
                                            <i class="pe-1 fa fa-list"></i>
                                            <span>Indikator SKM</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                <!-- Perizinan -->
                @can('layanan')
                    <li>
                        <a href="{{ route('layanan.index') }}">
                            <i class="fa fa-wrench"></i>
                            <span> Perizinan </span>
                        </a>
                    </li>
                @endcan

                <!-- Pengumuman -->
                @can('pengumuman')
                    <li>
                        <a href="{{ route('pengumuman.index') }}">
                            <i class="fa fa-bullhorn"></i>
                            <span> Pengumuman </span>
                        </a>
                    </li>
                @endcan


                <!-- Pengaturan -->
                @canany(['carousel', 'kontak', 'link terkait', 'tentang'])
                    <li>
                        <a href="#setting" data-bs-toggle="collapse">
                            <i class="fa fa-cog"></i>
                            <span> Pengaturan </span>
                            <span class="fa fa-angle-right"></span>
                        </a>
                        <div class="collapse" id="setting">
                            <ul class="nav-second-level">
                                @can('carousel')
                                    <li>
                                        <a href="{{ route('carousel.index') }}">
                                            <i class="pe-1 fa fa-image"></i>
                                            <span>Carousel</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('kontak')
                                    <li>
                                        <a href="{{ route('kontak.all') }}">
                                            <i class="pe-1 fa fa-address-book"></i>
                                            <span>Kontak</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('link terkait')
                                    <li>
                                        <a href="{{ route('link-terkait.index') }}">
                                            <i class="pe-1 fa fa-link"></i>
                                            <span>Link Terkait</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('tentang')
                                    <li>
                                        <a href="{{ route('tentang.index') }}">
                                            <i class="pe-1 fa fa-info-circle"></i>
                                            <span>Tentang</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany
                <!-- Pengumuman -->
                @can('user')
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-users"></i>
                            <span> User </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
