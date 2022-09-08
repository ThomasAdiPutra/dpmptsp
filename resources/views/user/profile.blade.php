@extends('layout.master-admin', ['title' => 'Profil'])

@section('head')
    <style>
        .col-12 {
            height: 100%;
        }

        .element {
            display: inline-flex;
            align-items: center;
        }

        i.fa-camera {
            margin: 10px;
            cursor: pointer;
            font-size: 30px;
        }

        i:hover {
            opacity: 0.6;
        }

        input {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="text-center mb-4">
        <img src="{{ $user->image }}" alt="{{ $user->name }}" class="rounded-circle img-thumbnail"
            style="height: 150px; width:150px;">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="text-center">
            @csrf
            @method('PATCH')
            <div class="element">
                <i class="fa fa-camera"></i>
                <span class="name">Ganti Foto</span>
                <input type="file" name="image" accept="image/*">
                <button type="submit" class="btn bg-transparent" style="font-size: 20px;"><i
                        class="fa fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
    <div class="row">
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
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" value="{{ $user->username }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="job-title" class="form-label">Jabatan</label>
                            <input type="text" name="job-title" id="job-title" value="{{ $user->job_title }}"
                                class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.change-password') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="old-password" class="form-label">Password Lama</label>
                            <input type="password" name="old_password" id="old-password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label">Password Baru</label>
                            <input type="password" name="new_password" id="new-password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-password-confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new-password-confirmation"
                                class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" name="facebook" id="facebook" value="{{ $user->facebook }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" name="instagram" id="instagram" value="{{ $user->instagram }}"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="Twitter" class="form-label">Twitter</label>
                            <input type="text" name="Twitter" id="Twitter" value="{{ $user->twitter }}"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("i.fa-camera").click(function() {
            $("input[type='file']").trigger('click');
        });

        $('input[type="file"]').on('change', function() {
            var val = $(this).val().split('\\');
            var name = val[val.length - 1];
            $(this).siblings('span').text(name);
        })
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
