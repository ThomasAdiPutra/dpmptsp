@extends('layout.master-admin', ['title' => 'Galeri'])
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <div class="card-header py-1">
            <div class="card-title">
                <h3>Tambah Foto</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                @csrf
                <label class="form-label" for="title">Judul Foto</label>
                <input type="text" class="form-control mb-3 mr-sm-2" id="title" placeholder="Judul Foto"
                    name="title" required>

                <label class="form-label" for="image">Foto</label>
                <div class="custom-file mb-2">
                    <input type="file" accept="image/*" class="custom-file-input form-control" id="image"
                        name="path" required>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header py-1">
            <div class="card-title">
                <h3>Daftar Foto</h3>
            </div>
        </div>
        <div class="card-body">
            <table id="galleries" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Judul</th>
                        <th>Foto</th>
                        <th>Diupload pada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $gallery)
                        <tr data-child-id="{{ $gallery->id }}" data-child-title="{{ $gallery->title }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <button class="btn btn-warning edit"><i class="fa fa-edit bg-warning"></i></button>
                                <button class="btn btn-danger delete"><i class="fa fa-trash bg-danger"></i></button>
                            </td>
                            <td>{{ $gallery->title }}</td>
                            <td><img src="{{ $gallery->path }}" class="img-thumbnail" alt="{{ $gallery->title }}"
                                    style="max-width: 150px;"></td>
                            <td>{{ date('d M Y H:i:s', strtotime($gallery->created_at)) }}</td>
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
        $(document).ready(function() {
            // Add event listener for opening and closing details
            $('#galleries tbody').on('click', 'button.edit', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var id = tr.data('child-id')
                var title = tr.data('child-title')
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(id, title)).show();
                    tr.addClass('shown');
                }
            });

            $('#galleries tbody').on('click', 'button.delete', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var id = tr.data('child-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    'url': `{{ url('/galeri') }}/${id}`,
                    'method': 'DELETE',
                    'data': {
                        'id': id,
                    }
                }).then((res, data, req) => {
                    if (req.status == 204) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: `Berhasil menghapus foto`,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        row.remove().draw(false);
                        let i = 1;

                        table.cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        }).every(function(cell) {
                            this.data(i++);
                        });
                    }
                })
            });

            const table = $('#galleries').DataTable({
                'lengthMenu': [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ],
                'columnDefs': [{
                        'searchable': false,
                        'target': [0],
                        'className': 'dt-center'
                    },
                    {
                        'searchable': false,
                        'orderable': false,
                        'target': [1],
                        'className': 'dt-center'
                    },
                    {
                        'className': 'align-middle dt-head-center',
                        'target': '_all'
                    },
                    {
                        'className': 'align-middle dt-center',
                        'target': [3]
                    }
                ],
            });

            function format(id, title) {
                return `
                    <form method='POST' action='{{ url('/galeri') }}/${id}' enctype='multipart/form-data' class='row'>
                        @csrf
                        @method('PATCH')
                        <div class="col-6">
                            <label class="form-label" for="edit-title">Judul Foto</label>
                            <input type="text" class="form-control mb-1 mr-sm-2" id="edit-title" placeholder="Judul Foto"
                            name="title" value='${title}' required>   
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="edit-path">Foto</label>
                            <input type='file' name='path' accept='image/*' id='edit-path' class="form-control mb-1 mr-sm-2">
                        </div>
                        <div class="col-12">
                            <button type='submit' class='btn btn-primary'>Submit</button>
                        </div>
                    </form>
                `;
            }
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
