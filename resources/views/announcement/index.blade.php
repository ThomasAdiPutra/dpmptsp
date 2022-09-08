@extends('layout.master-admin', ['title' => 'Pengumuman'])
@section('head')
    <x-head.tinymce-config images_upload_url="{{ route('images.upload.announcement') }}" />
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

        img {
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="announcementsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Judul Pengumuman</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Isi Pengumuman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr data-id='{{ $announcement->id }}' data-start-date='{{ $announcement->start_date }}'
                            data-end-date='{{ $announcement->end_date }}'>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success me-2 show"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-warning me-2 edit"><i class="fa fa-edit"></i></button>
                                    <form action="{{ route('pengumuman.destroy', ['pengumuman' => $announcement->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ date('d M Y', strtotime($announcement->start_date)) }}</td>
                            <td>{{ date('d M Y', strtotime($announcement->end_date)) }}</td>
                            <td>
                                @if (\Carbon\Carbon::now()->between(
                                    \Carbon\Carbon::parse($announcement->start_date),
                                    \Carbon\Carbon::parse($announcement->end_date)->addDays(1)))
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>{!! $announcement->content !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Announcement Modal -->
    <div class="modal fade" id="addAnnouncementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addAnnouncementLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnnouncementLabel">Buat Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengumuman.store') }}" method="POST" id="add-announcement">
                        @csrf
                        <div class="mb-3">
                            <label for="add-title" class="form-label">Judul pengumuman</label>
                            <input type="text" name="title" id="add-title" class="form-control"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-content" class="form-label">Isi pengumuman</label>
                            <textarea name="content" id="add-content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-start-date" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="add-start-date" class="form-control"
                                value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-end-date" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="end_date" id="add-end-date" class="form-control"
                                value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="add-announcement">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Announcement Modal -->
    <div class="modal fade" id="editAnnouncementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editAnnouncementLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnnouncementLabel">Edit Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="edit-announcement">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="edit-title" class="form-label">Judul Pengumuman</label>
                            <input type="text" name="title" id="edit-title" class="form-control"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit-content" class="form-label">Isi pengumuman</label>
                            <textarea name="content" id="edit-content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit-start-date" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="edit-start-date" class="form-control"
                                value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit-end-date" class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="edit-end-date" class="form-control"
                                value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="edit-announcement">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Announcement Modal -->
    <div class="modal fade" id="showAnnouncementModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="showAnnouncementLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showAnnouncementLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="show-announcement"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        const table = $('table#announcementsTable').DataTable({
            'dom': 'lBftrip',
            'buttons': [{
                'text': 'Buat Pengumuman',
                'action': function(e, dt, node, config) {
                    $('#addAnnouncementModal').modal('show');
                }
            }, ],
            'columnDefs': [{
                    'className': 'dt-center',
                    'target': [0, 3, 4, 5]
                },
                {
                    'className': 'dt-head-center align-middle',
                    'target': '_all'
                },
                {
                    'width': '15px',
                    'target': [0]
                },
                {
                    'width': '50px',
                    'target': [1]
                },
                {
                    'orderable': false,
                    'searchable': false,
                    'target': [1]
                },
                {
                    'type': 'date',
                    'target': [3, 4]
                },
                {
                    'visible': false,
                    'target': [6]
                },
            ],
        });

        $('tbody').on('click', 'button.edit', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');
            var title = row.data()[2];
            var content = row.data()[6];
            var start_date = tr.data('startDate');
            var end_date = tr.data('endDate');
            $('#edit-title').val(title);
            tinyMCE.get('edit-content').setContent(content);
            $('#edit-start-date').val(start_date);
            $('#edit-end-date').val(end_date);
            $('#editAnnouncementModal').modal('show');
            $('form#edit-announcement').attr('action', `{{ url('/pengumuman') }}/${id}`);
        });

        $('tbody').on('click', 'button.show', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var title = row.data()[2];
            var content = row.data()[6];
            $('#show-announcement').html(content);
            $('#showAnnouncementModal').modal('show');
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
