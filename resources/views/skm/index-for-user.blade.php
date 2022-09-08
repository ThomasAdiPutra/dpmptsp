@extends('layout.master-admin', ['title' => 'SKM'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <style>
        div.dataTables_length {
            float: left;
        }

        div.dataTables_filter {
            float: right;
        }

        div.dt-buttons {
            margin-left: 1rem;
        }
    </style>
@endsection

@section('content')
    @if ($errors->any())
        <div class="card">
            <div class="card-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">Survei Kepuasan Masyarakat Seluruh Periode</div>
                <div class="card-body">
                    <table class="table table-striped" id="per-period">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Periode</th>
                                <th>Jumlah Peserta</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skm as $period)
                                <tr data-id='{{ $period->id }}' data-start-period='{{ $period->start_period }}'
                                    data-end-period='{{ $period->end_period }}' data-male='{{ $period->male }}'
                                    data-female='{{ $period->female }}'>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-warning me-2 edit"><i class="fa fa-edit"></i></button>
                                            <form action="{{ route('skm.destroy', ['skm' => $period->id]) }}" method="post"
                                                class="d-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $period->start_period }} - {{ $period->end_period }}</td>
                                    <td>{{ $period->male + $period->female }}</td>
                                    <td>{{ $period->male }}</td>
                                    <td>{{ $period->female }}</td>
                                    <td>{{ $period->result->average('score') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">Survei Kepuasan Masyarakat Periode
                    {{ $start_period }} - {{ $end_period }}
                </div>
                <div class="card-body">
                    <form action="" method="get" class="row mb-3">
                        <div class="col-9 col-md-10">
                            <select name="periode" id="" class="form-select">
                                @foreach ($skm as $period)
                                    <option value="{{ $period->id }}">{{ $period->start_period }} -
                                        {{ $period->end_period }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 col-md-2"><button type="submit" class="btn btn-primary"
                                style="width: 100%;">Filter</button></div>
                    </form>
                    <table class="table table-striped" id="spesific-period">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Indikator</th>
                                <th>Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $indicator)
                                <tr data-period-id='{{ $id_period }}' data-indicator-id='{{ $indicator->id }}'>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @if (!$indicator->result->isEmpty())
                                                <button class="btn btn-warning me-2 edit"
                                                    data='{{ $indicator->result->first()->id }}'><i
                                                        class="fa fa-edit"></i></button>
                                                <form
                                                    action="{{ route('skm-result.destroy', ['skm_result' => $indicator->result->first()->id]) }}"
                                                    method="post" class="d-flex">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @else
                                                <button class="btn btn-primary me-2 add"><i class="fa fa-plus"></i></button>
                                            @endif

                                        </div>
                                    </td>
                                    <td>{{ $indicator->question }}</td>
                                    <td>{{ $indicator->result->first()->score ?? 'Tidak ada data' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addPeriod" tabindex="-1" aria-labelledby="addPeriodLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPeriodLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('skm.store') }}" method="post" id="add-period">
                        @csrf
                        <div class="mb-3">
                            <label for="start_period" class="form-label">Periode</label>
                            <div class="row">
                                <div class="col-6"><input type="date" name="start_period" id="start_period"
                                        class="form-control" required></div>
                                <div class="col-6"><input type="date" name="end_period" id="end_period"
                                        class="form-control" required></div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="male" class="form-label">Jumlah Peserta Laki-laki</label>
                            <input type="number" name="male" id="male" class="form-control" min="0"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="female" class="form-label">Jumlah Peserta Perempuan</label>
                            <input type="number" name="female" id="female" class="form-control" min="0"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="add-period">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script>
        const tableAllPeriod = $('#per-period').DataTable({
            'dom': 'lBftrip',
            'lengthMenu': [3, 5, 10, 100],
            'buttons': [{
                'text': 'Periode Baru',
                'action': function(e, dt, node, config) {
                    $('#addPeriod').modal('show');
                }
            }, ],
            'columnDefs': [{
                    'className': 'dt-head-center align-middle',
                    'target': '_all'
                },
                {
                    'className': 'dt-center',
                    'target': [0, 1, ]
                },
            ],
        });

        const tableSpesificPeriod = $('#spesific-period').DataTable({
            'columnDefs': [{
                    'className': 'dt-head-center align-middle',
                    'target': '_all'
                },
                {
                    'className': 'dt-center',
                    'target': [0, 1]
                },
            ],
        });

        function addRowPeriod(id, start_period, end_period, male, female) {
            return `
            <form method='POST' action='{{ url('/skm') }}/${id}' class='row'>
                @csrf
                @method('PATCH')
                <div class="col-6">
                    <label class="form-label">Periode</label>
                    <input type='date' name='start_period' class="form-control mb-3 mr-sm-2" value='${start_period}' required>
                </div>
                <div class="col-6">
                    <label class="form-label"><span class='text-white'>Periode</span></label>
                    <input type='date' name='end_period' class="form-control mb-3 mr-sm-2" value='${end_period}' required>
                </div>
                <div class="col-6">
                    <label for="edit-male">Laki-laki</label>    
                    <input type="number" name="male" id="edit-male" min=0 class="form-control" value='${male}' required/>
                </div>
                <div class="col-6">
                    <label for="edit-female">Perempuan</label>    
                    <input type="number" name="female" id="edit-female" min=0 class="form-control" value='${female}' required/>
                </div>
                <div class="mt-2">
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </div>
            </form>
            `;
        }

        $('#per-period tbody').on('click', 'button.edit', function() {
            var tr = $(this).closest('tr');
            var row = tableAllPeriod.row(tr);
            var id = tr.data('id');
            var start_period = tr.data('start-period');
            var end_period = tr.data('end-period');
            var male = tr.data('male');
            var female = tr.data('female');
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(addRowPeriod(id, start_period, end_period, male, female)).show();
                tr.addClass('shown');
            }
        });

        $('#spesific-period tbody').on('click', 'button.add', function() {
            var tr = $(this).closest('tr');
            var row = tableSpesificPeriod.row(tr);
            var skm_id = tr.data('periodId');
            var skm_indicator_id = tr.data('indicatorId');
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(addRow(`{{ url('/skm-result') }}`, 'POST', skm_id, skm_indicator_id, 0)).show();
                tr.addClass('shown');
            }
        });

        $('#spesific-period tbody').on('click', 'button.edit', function() {
            var tr = $(this).closest('tr');
            var row = tableSpesificPeriod.row(tr);
            var id = $(this).attr('data');
            var skm_id = tr.data('periodId');
            var skm_indicator_id = tr.data('indicatorId');
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(addRow(`{{ url('/skm-result') }}/${id}`, 'PATCH', skm_id, skm_indicator_id, 0)).show();
                tr.addClass('shown');
            }
        });

        function addRow(url, method, skm_id, skm_indicator_id, score) {
            return `
            <form method='POST' action='${url}'>
                @csrf
                @method('${method}')
                <input type="hidden" name="skm_id" value='${skm_id}'/>
                <input type="hidden" name="skm_indicator_id" value='${skm_indicator_id}'/>
                <div class="mb-2">
                    <label class="form-label">Score</label>
                    <input type="number" step="0.01" min='0' max=100 name='score' class="form-control" value='${score}' required>
                </div>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </form>
            `;
        }
    </script>

    @if (session()->has('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: `{{ session()->get('success') }}`,
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif(session()->has('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: `{{ session()->get('error') }}`,
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
