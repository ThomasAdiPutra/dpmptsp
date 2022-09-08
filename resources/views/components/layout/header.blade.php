<header id="header">
    <div class="container-fluid">
        <div id="logo" class="pull-left pt-1">
            {{-- <h1><a href="/" class="scrollto">DPMPTSP</a></h1> --}}
            <a href="/"><img src="{{ asset('') . $logo }}" alt="Logo" title="" width="400px" /></a>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu"><a href="/">Beranda</a></li>
                <li class="menu-has-children"><a href="#">Tentang</a>
                    <ul>
                        <li class="menu"><a href="{{ route('about.profil') }}">Profil</a></li>
                        <li class="menu"><a href="{{ route('about.visi-misi') }}">Visi Misi</a></li>
                        <li class="menu"><a href="{{ route('about.maklumat-pelayanan') }}">Maklumat Pelayanan</a></li>
                        <li class="menu"><a href="{{ route('about.standar-pelayanan') }}">Standar Pelayanan</a>
                        <li class="menu"><a href="{{ route('about.struktur-organisasi') }}">Struktur Organisasi</a>
                        </li>
                        <li class="menu"><a href="{{ route('about.sop') }}">Standar Operasional Prosedur</a></li>
                    </ul>
                </li>
                <li class="menu-has-children"><a href="#">Perizinan</i></a>
                    <ul>
                        @foreach ($services as $service)
                            <li class="menu"><a
                                    href="{{ route('layanan.show', ['layanan' => str_replace(' ', '-',$service->name)]) }}">{{ $service->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="menu"><a href="{{ route('galeri.index') }}">Galeri</a></li>
                <li class="menu"><a href="{{ route('berita.index') }}">Berita</a></li>
                <li class="menu-has-children"><a href="#">Interaksi Masyarakat</i></a>
                    <ul>
                        <li class="menu"><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                        <li class="menu">
                            <a href="https://ketapangkab.go.id">Survey Kepuasan Masyarakat</a>
                        </li>
                        <li class="menu"><a href="{{ route('publikasi-nilai.index') }}">Publikasi Nilai</a></li>
                    </ul>
                </li>
                <li class="menu-has-children"><a href="#">Informasi</i></a>
                    <ul>
                        <li class="menu"><a href="{{ route('kontak.index') }}">Kontak</a></li>
                        <li class="menu"><a href="{{ route('agenda.index') }}">Agenda</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</header>
