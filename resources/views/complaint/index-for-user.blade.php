@extends('layout.master-admin', ['title'=>'Pengaduan'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" style="width: 100%" id="complaints">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Judul Aduan</th>
                        <th>Isi Aduan</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                        <tr data-id="{{ $complaint->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-success show"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-primary mx-1 toggle"><i
                                            class="fa fa-{{ $complaint->active == '1' ? 'lock' : 'unlock' }}"></i></button>
                                    <button class="btn btn-danger destroy"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                            <td>{{ $complaint->name }}</td>
                            <td>{{ $complaint->judul_aduan }}</td>
                            <td>{{ Str::words($complaint->isi_aduan, 20) }}</td>
                            <td>{{ date('d M Y', strtotime($complaint->created_at)) }}</td>
                            <td>
                                @if ($complaint->active == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak aktif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        const table = $('#complaints').DataTable({
            'columnDefs': [{
                    'target': [0, 1, 5, 6],
                    'className': 'dt-center'
                },
                {
                    'target': [2, 3, 4],
                    'className': 'dt-head-center'
                },
                {
                    'target': 1,
                    'orderable': false,
                    'searchable': false
                },
                {
                    'target': 5,
                    'type': 'date'
                },
            ],
        });

        $('tbody').on('click', 'button.show', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');
            window.location.href = `{{ url('pengaduan/detail') }}/${id}`;
        });

        $('tbody').on('click', 'button.toggle', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            });

            $.ajax({
                'url': `{{ url('/pengaduan/toggle') }}/${id}`,
                'method': 'PATCH',
            }).then((res, msg, req) => {
                if (req.status === 204) {
                    var icon = $(this).children('i');
                    var badge = $($(tr).find('td:last').children('span'));
                    if (icon.attr('class') == 'fa fa-lock') {
                        icon.attr('class', 'fa fa-unlock');
                        $(badge).html('Tidak aktif')
                        $(badge).attr('class', 'badge bg-danger');
                    } else {
                        icon.attr('class', 'fa fa-lock');
                        $(badge).html('Aktif')
                        $(badge).attr('class', 'badge bg-success');
                    }
                    swal('Berhasil');
                }
            });
        });

        $('tbody').on('click', 'button.destroy', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            });

            $.ajax({
                'url': `{{ url('/pengaduan') }}/${id}`,
                'method': 'DELETE',
            }).then((res, msg, req) => {
                if (req.status === 204) {
                    row.remove();
                    let i = 1;
                    table.cells(null, 0, {
                        search: 'applied',
                        order: 'applied'
                    }).every(function(cell) {
                        this.data(i++);
                    }).draw();
                    swal('Berhasil menghapus pengaduan');
                }
            });
        });

        function swal(message){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: `${message}`,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endsection
