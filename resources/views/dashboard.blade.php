@extends('layout.master-admin', ['title' => 'Dashboard'])

@section('head')
    <style>
        #skm {
            max-height: 280px !important;
        }

        .row-eq-height {
            height: 100% !important;
        }

        .col-6 .card {
            height: 100%;
        }

        #visitor {
            height: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="{{ route('skm.index') }}" class="dropdown-item">Selengkapnya</a>
                        </div>
                    </div>

                    <h4 class="header-title mt-0 mb-4">Hasil SKM</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1 float-start" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#10c469"
                                data-bgColor="rgba(16,196,105,0.2)" value="{{ round($skm->result->average('score'), 2) }}"
                                data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                        </div>

                        <div class="widget-detail-1 text-end">
                            <h2 class="fw-normal pt-2 mb-1">{{ round($skm->result->average('score'), 2) }}%</h2>
                            <p class="text-muted mb-1">Puas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="{{ route('pengaduan.index') }}" class="dropdown-item">Selengkapnya</a>
                        </div>
                    </div>

                    <h4 class="header-title mt-0 mb-4">Pengaduan</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1 float-start" dir="ltr">
                            <i class="fa fa-exclamation-triangle fa-5x text-danger"></i>
                        </div>
                        <div class="widget-detail-1 text-end">
                            <h2 class="fw-normal pt-2 mb-1"> {{ $complaint }} </h2>
                            <p class="text-muted mb-1">Aduan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="{{ route('berita.index') }}" class="dropdown-item">Selengkapnya</a>
                        </div>
                    </div>

                    <h4 class="header-title mt-0 mb-4">Info Terkini</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1 float-start" dir="ltr">
                            <i class="fa fa-newspaper fa-5x text-dark"></i>
                        </div>
                        <div class="widget-detail-1 text-end">
                            <h2 class="fw-normal pt-2 mb-1"> {{ $news }} </h2>
                            <p class="text-muted mb-1">Berita</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-4">Kunjungan</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1 float-start" dir="ltr">
                            <i class="fa fa-users fa-5x text-primary"></i>
                        </div>
                        <div class="widget-detail-1 text-end">
                            <h2 class="fw-normal pt-2 mb-1"> {{ $visitor['all'] }} </h2>
                            <p class="text-muted mb-1">Kali</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

    <div class="row row-eq-height">
        <!-- SKM -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="skm"></canvas>
                </div>
            </div>
        </div>

        <!-- Visitor -->
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="visitor"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = [
            @foreach ($visitor['week'] as $visit)
                '{{ date('d M y', strtotime($visit->date)) }}',
            @endforeach
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Kunjungan',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    @foreach ($visitor['week'] as $visit)
                        {{ $visit->count }},
                    @endforeach
                ],
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Kunjungan Minggu Ini',
                    },
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
            }
        };
    </script>

    <script>
        const visitor = new Chart(
            document.getElementById('visitor'),
            config
        );
    </script>

    <script>
        const dataSKM = {
            labels: [
                'Laki-laki',
                'Perempuan'
            ],
            datasets: [{
                data: [{{ $skm->male }}, {{ $skm->female }}],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        const configSKM = {
            type: 'pie',
            data: dataSKM,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Survey Kepuasan Masyarakat',
                    },
                },
            },
        };

        const skm = new Chart(
            document.getElementById('skm'),
            configSKM
        );
    </script>
@endsection
