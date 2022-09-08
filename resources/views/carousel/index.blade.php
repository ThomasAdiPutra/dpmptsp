@extends('layout.master-admin', ['title' => 'Carousel'])
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
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
            <div class="card-title h4 my-0">Tambah Carousel</div>
        </div>
        <div class="card-body">
            <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="path" class="form-label">Carousel</label>
                    <input type="file" name="path" id="path" accept="image/*" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title h4 my-0">Daftar Carousel</div>
        </div>
        <div class="card-body">
            <table id="carousels" class="table table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Carousel</th>
                        <th>Diupload pada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carousels as $carousel)
                        <tr data-child-id="{{ $carousel->id }}" data-child-title="{{ $carousel->title }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-warning edit me-2"><i class="fa fa-edit"></i></button>
                                    <form action="{{ route('carousel.destroy', ['carousel' => $carousel->id]) }}"
                                        method="POST">
                                        @csrf()
                                        @method('DELETE')
                                        <input type="hidden" name="path" value="{{ $carousel->id }}">
                                        <button type='submit' class="btn btn-danger"><i
                                                class="fa fa-trash bg-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td><img src="{{ $carousel->path }}" class="img-thumbnail" alt="{{ $carousel->path }}"
                                    style="max-width: 250px;"></td>
                            <td>{{ date('d M Y', strtotime($carousel->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#carousels').DataTable({
                'lengthMenu': [5, 10, 50, 100],
                'columnDefs': [{
                        'target': '_all',
                        'className': 'align-middle dt-center'
                    },
                    {
                        'target': 0,
                        'width': '30px'
                    },
                    {
                        'target': 1,
                        'width': '120px',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        'target': 2,
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        'target': 3,
                        'type': 'date'
                    },
                ],
            });

            function format(id, title) {
                return `
                    <form method='POST' action='{{ url('/carousel') }}/${id}' enctype='multipart/form-data'>
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="edit-path" class="form-label"></label>
                            <input type='file' id='edit-path' name='path' accept='image/*' class='form-control' required>
                        </div>
                        <button type='submit' class='btn btn-primary'>Submit</button>
                    </form>
                `;
            }

            $('#carousels tbody').on('click', 'button.edit', function() {
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
        });
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
