@extends('layout.master-admin', ['title' => 'Berita'])

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
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="news" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Jumlah dilihat</th>
                        <th>Diupload pada</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script>
        const table = $('#news').DataTable({
            'dom': 'lBftrip',
            'buttons': [{
                'text': 'Tambah Berita',
                'action': function(e, dt, node, config) {
                    window.location.href = `{{ route('berita.create') }}`;
                }
            }, ],
            'scrollX': true,
            'ajax': '{{ route('api.berita.index') }}',
            'serverSide': true,
            'columns': [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'action'
                },
                {
                    data: 'category.category'
                },
                {
                    data: 'title'
                },
                {
                    data: 'views'
                },
                {
                    data: 'created_at',
                    render: function($data) {
                        return $data.split('T')[0];
                    }
                },
                {
                    data: 'active',
                    render: function($data) {
                        if ($data == 1) {
                            return 'Aktif';
                        }
                        return 'Tidak Aktif';
                    }
                },
            ],
            'columnDefs': [{
                    'searchable': false,
                    'orderable': false,
                    'target': [0, 1]
                },
                {
                    'width': '160px',
                    "targets": 1
                },
                {
                    'className': 'dt-head-center align-middle',
                    'target': '_all'
                },
                {
                    'className': 'dt-center align-middle',
                    'target': [0, 1, 4, 5, 6]
                },
            ]
        });

        $('tbody').on('click', 'button.btn-primary', function() {
            let url = $(this).attr('url');
            $.ajax({
                'url': url,
            }).then(() => {
                table.ajax.reload();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: `Berhasil mengubah status`,
                    showConfirmButton: false,
                    timer: 1000
                })
            })
        });
    </script>
    @if (session()->has('success'))
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
