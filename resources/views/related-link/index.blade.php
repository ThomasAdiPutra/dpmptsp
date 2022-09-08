@extends('layout.master-admin', ['title' => 'Link Terkait'])
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <style>
        div.dataTables_length,
        .dataTables_info {
            float: left;
        }

        div.dataTables_filter,
        .dataTables_paginate {
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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('link-terkait.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="add-name" class="form-label">Nama</label>
                        <input type="text" name="name" id="add-name" class="form-control" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="add-logo" class="form-label">Logo</label>
                        <input type="file" name="logo" id="add-logo" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-link" class="form-label">Link</label>
                        <input type="url" name="link" id="add-link" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="related-links">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Logo</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($relatedLinks as $relatedLink)
                        <tr data-id="{{ $relatedLink->id }}" data-name='{{ $relatedLink->name }}'
                            data-link='{{ $relatedLink->link }}'>
                            <td></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-warning edit me-2"><i class="fa fa-edit"></i></button>
                                    <form action="{{ route('link-terkait.destroy', ['link_terkait' => $relatedLink->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $relatedLink->name }}</td>
                            <td><img src="{{ $relatedLink->logo }}" alt="{{ $relatedLink->name }}" class="img-thumbnail"
                                    width="200px">
                            </td>
                            <td><a href="{{ $relatedLink->link }}">{{ $relatedLink->link }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form style="display: none" action="{{ route('link-terkait.urutan') }}" method="POST" id="order">
        @csrf
        <input type="hidden" name="order" />
    </form>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script>
        var data = {};
        const table = $('#related-links').DataTable({
            'dom': 'lBftrip',
            'buttons': [{
                'text': 'Simpan Urutan',
                'action': function(e, dt, node, config) {
                    var rows = table.rows({
                        page: 'current'
                    }).nodes();
                    rows.each(tr => {
                        var row = table.row(tr);
                        var id = $(tr).attr('data-id');
                        var order = row.data()[0];
                        data[id] = order;
                    });
                    $('input[name=order]').val(JSON.stringify(data));
                    $('#order').submit();
                }
            }, ],
            'columnDefs': [{
                    'target': '_all',
                    'className': 'dt-head-center align-middle'
                },
                {
                    'target': [0],
                    'className': 'dt-center'
                },
                {
                    'target': [1],
                    'className': 'action-button'
                },
            ],
            'lengthMenu': [5, 10, 50, 100],
            'rowReorder': {
                selector: 'td:not(.action-button)'
            },
        });

        table.on('order.dt search.dt', function() {
            let i = 1;
            table.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();

        table.on('row-reorder', function() {
            let i = 1;
            table.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();

        $('tbody').on('click', 'button.edit', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');
            var name = tr.data('name');
            var link = tr.data('link');
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format(id, name, link)).show();
                tr.addClass('shown');
            }
        });

        function format(id, name, link) {
            return `
            <form method='POST' action='{{ url('/link-terkait') }}/${id}' enctype='multipart/form-data' class='row'>
                @csrf
                @method('PATCH')
                <div class="col-4">
                    <label class="form-label" for="edit-name">Nama</label>
                    <input type='text' name='name' id='edit-name' class="form-control mb-2 mr-sm-2" value='${name}' required>
                </div>
                <div class="col-4">
                    <label class="form-label" for="edit-logo">Logo</label>
                    <input type='file' name='logo' accept='image/*' id='edit-logo' class="form-control mb-2 mr-sm-2">
                </div>
                <div class="col-4">
                    <label class="form-label" for="edit-link">Link</label>
                    <input type='url' name='link' id='edit-link' class="form-control mb-2 mr-sm-2" value='${link}' required>
                </div>
                <div><button type='submit' class='btn btn-primary'>Submit</button></div>
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
