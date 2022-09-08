@extends('layout.master-admin', ['title' => 'Layanan'])
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <x-head.tinymce-config selector='#new-detail' />
    <x-head.tinymce-config selector='#edit-detail' script='false' />
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

        .select2-selection__rendered,
        .select2-results {
            font-family: "Font Awesome\ 5 Free";
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
    
    <div class="card">
        <div class="card-header">
            <div class="my-1 h4">Daftar Layanan</div>
        </div>
        <div class="card-body">
            <table id="services" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Icon</th>
                        <th>Nama Layanan</th>
                        <th>Deskripsi Singkat</th>
                        <th>Detil Layanan</th>
                        <th>Jumlah Jenis Izin</th>
                        <th>Jumlah Berkas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr data-id='{{ $service->id }}'>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex">
                                    <button title="Detail" href="#" class="btn btn-success detail"><i
                                            class="fa fa-eye"></i></button>
                                    <button title="Edit" href="#" class="btn btn-warning mx-1 edit"><i
                                            class="fa fa-edit"></i></button>
                                    <form action="{{ route('layanan.destroy', ['layanan' => $service->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button title="Hapus" type="submit" class="btn btn-danger"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td><i class="fa {{ $service->icon }}"></i></td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->description }}</td>
                            <td>{!! $service->detail ?? 'Tidak ada detil' !!}</td>
                            <td>{{ $service->permission_count }}</td>
                            <td>{{ $service->permission_form_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="serviceModal" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true"
        data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method='POST' id="edit">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="icon" class="form-label">Ikon</label>
                            <x-select-icon name='icon' className="form-select" />
                        </div>
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Nama Layanan</label>
                            <input type="text" name="name" id="edit name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Deskripsi Singkat</label>
                            <input type="text" name="description" id="edit-description" class="form-control" required>
                        </div>
                        <div class="">
                            <label for="name" class="form-label">Detil Layanan</label>
                            <textarea name="detail" id="edit-detail" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="edit">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const table = $('#services').DataTable({
            'dom': 'lBftrip',
            'buttons': [{
                'text': 'Tambah Layanan',
                'action': function(e, dt, node, config) {
                    window.location.href = `{{ route('layanan.create') }}`;
                }
            }, ],
            'columnDefs': [{
                    'className': 'dt-head-center align-middle',
                    'target': '_all'
                },
                {
                    'className': 'dt-center',
                    'target': [0, 1, 2, 6, 7]
                },
            ],
        });

        $('tbody').on('click', 'button.detail', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var name = row.data()[3];
            window.location.href = `{{ url('/layanan') }}/${slug(name)}/detail`;
        });

        $('tbody').on('click', 'button.edit', function() {
            // $('select[name=icon]').select2();
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');
            var icon = $(row.nodes()[0]).find('td').eq(2).children().attr('class').split(' ')[1];
            var name = row.data()[3];
            var description = row.data()[4];
            var detail = row.data()[5];
            $("#edit select[name=icon]").val(icon).change();
            $('#edit .modal-title').html(name);
            $('#edit input[name=name]').val(name);
            $('#edit input[name=description]').val(description);
            if (detail != 'Tidak ada detil') {
                tinyMCE.get('edit-detail').setContent(detail);
            }
            $('form#edit').attr('action', `{{ url('/layanan') }}/${id}`);

            $('#serviceModal').modal('show');
            $('#serviceModalLabel').html(name);
        });

        function slug(name) {
            return name.toLowerCase().replace(/\s+/g, '-');
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
            })
        </script>
    @endif
@endsection
