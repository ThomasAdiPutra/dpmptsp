@extends('layout.master-admin', ['title' => 'Kategori'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="add-category" class="form-label">Nama Kategori</label>
                    <input type="text" name="category" id="add-category" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="categories" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr data-id="{{ $category->id }}" data-category="{{ $category->category }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-1 edit"><i class="fa fa-edit"></i></button>
                                    <form action="{{ route('kategori.destroy', ['kategori' => $category->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $category->category }}</td>
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
    <script>
        const table = $('#categories').DataTable({
            'columnDefs': [{
                    'searchable': false,
                    'orderable': false,
                    'target': [0, 1]
                },
                {
                    'width': '30px',
                    'className': 'dt-center align-middle',
                    "targets": 0
                },
                {
                    'width': '150px',
                    'className': 'dt-center align-middle',
                    "targets": 1
                },
                {
                    'className': 'dt-head-center align-middle',
                    'target': 2
                },
            ]
        });

        $('tbody').on('click', 'button.edit', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id')
            var category = tr.data('category')
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format(id, category)).show();
                tr.addClass('shown');
            }
        });

        function format(id, category) {
            return `
            <form method='POST' action='{{ url('/kategori') }}/${id}'>
                @csrf
                @method('PATCH')
                <div class="mb-2">
                    <label class="form-label" for="edit-category">Kategori</label>
                    <input type='text' name='category' id='edit-category' class="form-control" value='${category}' required>
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
