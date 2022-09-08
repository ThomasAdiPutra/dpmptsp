@extends('layout.master-admin', ['title' => 'Daftar User'])

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

        .fa-passwd-reset>.fa-lock,
        .fa-passwd-reset>.fa-key {
            font-size: 0.85rem;
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
            <table class="table table-striped" id="users">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Foto Profil</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Jabatan</th>
                        <th>Sosial Media</th>
                        <th>Hak Akses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr data-id='{{ $user->id }}'>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex">
                                    <form action="{{ route('user.reset-password', ['user' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success reset-password"
                                            title="Reset password">
                                            <i class="fa fa-lock"></i>
                                    </form>
                                    <button class="btn btn-warning mx-1 edit"><i class="fa fa-edit"></i></button>
                                    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td><img src="{{ $user->image == '' ? asset('asset/img/profile/default.png') : $user->image }}"
                                    alt="{{ $user->name }}" class="img-thumbnail" style="max-height: 150px;"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->job_title }}</td>
                            <td>
                                <ul>
                                    @if ($user->facebook != '')
                                        <li class="mb-1"><a href="{{ $user->facebook }}">Facebook</a></li>
                                    @endif

                                    @if ($user->instagram != '')
                                        <li class="mb-1"><a href="{{ $user->instagram }}">Instagram</a></li>
                                    @endif

                                    @if ($user->instagram != '')
                                        <li class="mb-1"><a href="{{ $user->twitter }}">Twitter</a></li>
                                    @endif
                                </ul>
                            </td>
                            <td>
                                @foreach ($user->permissions as $permission)
                                    <span class="badge bg-success">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" id="add-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="add-user-name" class="form-label">Nama</label>
                            <input type="text" name="name" id="add-user-name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="add-user-password" class="form-label">Password</label>
                            <input type="password" name="password" id="add-user-password" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="add-user-password-confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password-confirmation" id="add-user-password-confirmation"
                                class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="add-user-image" class="form-label">Foto</label>
                            <input type="file" name="image" id="add-user-image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-2">
                            <label for="add-user-username" class="form-label">Username</label>
                            <input type="text" name="username" id="add-user-username" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="add-user-job-title" class="form-label">Jabatan</label>
                            <input type="text" name="job_title" id="add-user-job-title" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <div class="form-label">Hak Akses</div>
                            <div class="row px-2">
                                @foreach ($permissions as $permission)
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}" id="add-{{ Str::slug($permission->name) }}">
                                        <label class="form-check-label" for="add-{{ Str::slug($permission->name) }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="add-user-facebook" class="form-label">Facebook</label>
                            <input type="text" name="facebook" id="add-user-facebook" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="add-user-instagram" class="form-label">Instagram</label>
                            <input type="text" name="instagram" id="add-user-instagram" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="add-user-twitter" class="form-label">Twitter</label>
                            <input type="text" name="twitter" id="add-user-twitter" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="add-user">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="edit-user-name" class="form-label">Nama</label>
                            <input type="text" name="name" id="edit-user-name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="edit-user-image" class="form-label">Foto</label>
                            <input type="file" name="image" id="edit-user-image" class="form-control"
                                accept="image/*">
                        </div>
                        <div class="mb-2">
                            <label for="edit-user-username" class="form-label">Username</label>
                            <input type="text" name="username" id="edit-user-username" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="edit-user-job-title" class="form-label">Jabatan</label>
                            <input type="text" name="job_title" id="edit-user-job-title" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <div class="form-label">Hak Akses</div>
                            <div class="row px-2">
                                @foreach ($permissions as $permission)
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}"
                                            id="edit-{{ Str::slug($permission->name) }}">
                                        <label class="form-check-label" for="edit-{{ Str::slug($permission->name) }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="edit-user-facebook" class="form-label">Facebook</label>
                            <input type="text" name="facebook" id="edit-user-facebook" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="edit-user-instagram" class="form-label">Instagram</label>
                            <input type="text" name="instagram" id="edit-user-instagram" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="edit-user-twitter" class="form-label">Twitter</label>
                            <input type="text" name="twitter" id="edit-user-twitter" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="edit-user">Submit</button>
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
        const table = $('#users').DataTable({
            'dom': 'lBftrip',
            'buttons': [{
                'text': 'User Baru',
                'action': function(e, dt, node, config) {
                    $('.modal#addUser').modal('show');
                }
            }, ],
            'columnDefs': [{
                    'target': [0, 1],
                    'className': 'dt-center'
                },
                {
                    'target': '_all',
                    'className': 'dt-head-center align-middle'
                },
                {
                    'target': 0,
                    'width': '30px'
                },
                {
                    'target': 1,
                    'width': '100px'
                },
                {
                    'target': 2,
                    'width': '150px'
                },
            ],
        });

        $('tbody').on('click', 'button.edit', function() {
            $('.edit-social-media').empty();
            $('form#edit-user input:checkbox').removeAttr('checked');

            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('id');
            var name = row.data()[3];
            var username = row.data()[4];
            var job_title = row.data()[5];
            var socialMedias = tr.find('td:last-child').prev().children().children().children();
            var permissions = tr.find('td:last-child').children();

            $('#edit-user-name').val(name);
            $('#edit-user-username').val(username);
            $('#edit-user-job-title').val(job_title);
            socialMedias.map((index, element) => {
                let name = $(element).text();
                let url = $(element).attr('href');
                $(`#edit-user-${name.toLowerCase()}`).val(url)
            });
            permissions.map((index, element) => {
                let permission = $(element).text().replace(' ', '-');
                $(`input#edit-${permission}`).attr('checked', 'checked');
            });

            $('form#edit-user').attr('action', `{{ url('/user') }}/${id}`);
            $('.modal#editUser').modal('show');
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
