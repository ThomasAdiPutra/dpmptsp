@extends('layout.master-admin', ['title'=>'Layanan'])
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <x-head.tinymce-config />
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
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3 pt-3" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-permission-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-permission" type="button" role="tab"
                        aria-controls="v-pills-permission" aria-selected="true">Perizinan</button>
                    <button class="nav-link" id="v-pills-file-tab" data-bs-toggle="pill" data-bs-target="#v-pills-file"
                        type="button" role="tab" aria-controls="v-pills-file" aria-selected="false">Berkas</button>
                    <button class="nav-link" id="v-pills-add-permission-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-add-permission" type="button" role="tab"
                        aria-controls="v-pills-add-permission" aria-selected="false">Tambah Izin</button>
                    <button class="nav-link" id="v-pills-add-file-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-add-file" type="button" role="tab" aria-controls="v-pills-add-file"
                        aria-selected="false">Tambah Berkas</button>
                </div>
                <div class="tab-content flex-grow-1" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-permission" role="tabpanel"
                        aria-labelledby="v-pills-permission-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @forelse ($service->permission as $permission)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->iteration == 1 ? 'active' : '' }}"
                                        id="{{ Str::slug($permission->name) }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#{{ Str::slug($permission->name) }}" type="button" role="tab"
                                        aria-controls="{{ $permission->name }}"
                                        aria-selected="true">{{ Str::words($permission->name, 5) }}</button>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @forelse ($service->permission as $permission)
                                <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : '' }}"
                                    id="{{ Str::slug($permission->name) }}" role="tabpanel"
                                    aria-labelledby="{{ Str::slug($permission->name) }}-tab">

                                    <div class="card">
                                        <div class="card-header">
                                            <div class="h4 float-start">{{ $service->name }} -
                                                {{ Str::words($permission->name, 10) }}</div>
                                            <form action="{{ route('izin.destroy', ['izin' => $permission->id]) }}"
                                                method="post" class="float-end">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('izin.update', ['izin' => $permission->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3">
                                                    <label for="label-name-{{ Str::slug($permission->name) }}"
                                                        class="form-label">Nama</label>
                                                    <input type="text" name="name"
                                                        id="label-name-{{ Str::slug($permission->name) }}"
                                                        class="form-control" value="{{ $permission->name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="label-req-{{ Str::slug($permission->name) }}"
                                                        class="form-label">Persyaratan</label>
                                                    <textarea name="requirement" id="label-name-{{ Str::slug($permission->req) }}" cols="30" rows="10"
                                                        class="form-control">{!! $permission->requirement !!}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                Belum ada izin
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-file" role="tabpanel" aria-labelledby="v-pills-file-tab">
                        <div style="max-width: 800px;" class="mx-auto">
                            <table class="table table-striped" id="file" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Berkas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($service->permissionForm as $file)
                                        <tr data-child-id='{{ $file->id }}' data-child-name='{{ $file->name }}'>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-warning me-2 edit"><i
                                                            class="fa fa-edit"></i></button>
                                                    <form action="{{ route('berkas.destroy', ['berka' => $file->id]) }}"
                                                        method="post" class="d-flex">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td><a href="{{ $file->form }}" download>{{ $file->name }}</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Tidak ada berkas</td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-add-permission" role="tabpanel"
                        aria-labelledby="v-pills-add-permission-tab">
                        <form action="{{ route('izin.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <div class="mb-3">
                                <label for="add-name" class="form-label">Nama</label>
                                <input type="text" name="name" id="add-name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="add-requirement">Persyaratan</label>
                                <textarea name="requirement" id="add-requirement" cols="30" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-add-file" role="tabpanel"
                        aria-labelledby="v-pills-add-file-tab">
                        <form method='POST' action='{{ route('berkas.store') }}' enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <div class="mb-3">
                                <label class="form-label" for="add-name">Nama</label>
                                <input type='text' name='name' id='add-name' class="form-control mb-3 mr-sm-2"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="add-form">Berkas</label>
                                <input type='file' name='form' accept='application/pdf' id='add-form'
                                    class="form-control mb-3 mr-sm-2" required>
                            </div>
                            <button type='submit' class='btn btn-primary'>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        const table = $('table#file').DataTable({
            'columnDefs': [{
                    'width': '10',
                    'target': [0]
                },
                {
                    'width': '80',
                    'target': [1]
                },
                {
                    'className': 'dt-head-center align-middle',
                    'target': '_all'
                },
                {
                    'className': 'dt-center',
                    'target': [0, 1]
                },
            ],
        });

        function format(id, name) {
            return `
            <form method='POST' action='{{ url('/berkas') }}/${id}' enctype='multipart/form-data' class='row'>
                @csrf
                @method('PATCH')
                <div class="col-5">
                    <label class="form-label" for="edit-name">Nama</label>
                    <input type='text' name='name' id='edit-name' class="form-control mb-3 mr-sm-2" value='${name}'>
                </div>
                <div class="col-5">
                    <label class="form-label" for="edit-form">Berkas</label>
                    <input type='file' name='form' accept='application/pdf' id='edit-form' class="form-control mb-3 mr-sm-2">
                </div>
                <div class="col-2 my-auto">
                    <button type='submit' class='btn btn-primary' style='width:100%'>Submit</button>
                </div>
            </form>
            `;
        }

        $('table#file tbody').on('click', 'button.edit', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('child-id')
            var name = tr.data('child-name')
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(id, name)).show();
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
            })
        </script>
    @endif
@endsection
