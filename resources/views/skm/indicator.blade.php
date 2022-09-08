@extends('layout.master-admin', ['title' => 'Indikator SKM'])

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    @error('question')
        <div class="card">
            <div class="card-body">
                <div class="text-danger">{{ $message }}</div>
            </div>
        </div>
    @enderror
    <div class="card">
        <div class="card-body">
            <form action="{{ route('indikator.store') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label for="add-question" class="form-label">Pertanyaan</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="indicators" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Pertanyaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($indicators as $indicator)
                        <tr data-id='{{ $indicator->id }}'>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-warning me-2 edit"><i class="fa fa-edit"></i></button>
                                    <form action="{{ route('indikator.destroy', ['indikator' => $indicator->id]) }}"
                                        method="post" class="d-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $indicator->question }}</td>
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
        const table = $('#indicators').DataTable({
            'columnDefs': [{
                    'className': 'dt-head-center align-middle',
                    'target': '_all'
                },
                {
                    'className': 'dt-center',
                    'target': [0, 1]
                },
                {
                    'target': 0,
                    'width': '30px',
                },
                {
                    'target': 1,
                    'width': '100px',
                    'orderable': false,
                    'searchable': false,
                },
            ],
        });

        function format(id, question) {
            return `
            <form method='POST' action='{{ url('/indikator') }}/${id}' enctype='multipart/form-data'>
                @csrf
                @method('PATCH')
                <div class="mb-2">
                    <label class="form-label" for="edit-question">Pertanyaan</label>
                    <input type='text' name='question' id='edit-question' class="form-control mb-3 mr-sm-2" value='${question}' required>
                </div>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </form>
            `;
        }

        $('table#indicators tbody').on('click', 'button.edit', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');
            var question = row.data()[2];
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(id, question)).show();
                tr.addClass('shown');
            }
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
