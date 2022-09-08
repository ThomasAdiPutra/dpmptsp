@extends('layout.master', ['title' => 'Survei Kepuasan Masyarakat'])
@section('head')
    <style>
        thead {
            text-align: center;
            font-weight: bold;
        }

        tfoot {
            text-align: center;
            font-weight: bold;
        }
    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-12 text-center mb-2">
            <h4>Survei Kepuasan Masyarakat Periode {{ date('d M Y', strtotime($skm->start_period)) }} -
                {{ date('d M Y', strtotime($skm->end_period)) }}</h4>
        </div>
        <div class="col-12 col-lg-8">
            @if (!$skm->result->isEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Indikator</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skm->result as $result)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $result->indicator->question }}</td>
                                <td class="text-center">{{ $result->score }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Rata-rata</td>
                            <td>{{ $skm->result->average('score') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <h4>Belum ada data</h4>
            @endif
        </div>
        <div class="col-12 col-lg-4">
            <div class="row">
                @if (!$skm->result->isEmpty())
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="kepuasan"></canvas>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="skm"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        text: 'Peserta (Jenis Kelamin)',
                    },
                },
            },
        };

        const skm = new Chart(
            document.getElementById('skm'),
            configSKM
        );
    </script>

    @if (!$skm->result->isEmpty())
        <script>
            const data_kepuasan = {
                labels: [
                    'Puas',
                    'Tidak Puas'
                ],
                datasets: [{
                    data: [{{ $skm->result->average('score') }}, {{ 100 - $skm->result->average('score') }}],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 86, 86)'
                    ],
                    hoverOffset: 4
                }]
            };

            const config_kepuasan = {
                type: 'pie',
                data: data_kepuasan,
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

            const kepuasan = new Chart(
                document.getElementById('kepuasan'),
                config_kepuasan
            );
        </script>
    @endif
@endsection
