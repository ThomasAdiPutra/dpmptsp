@extends('layout.master-admin', ['title'=>'Layanan'])
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <x-head.tinymce-config images_upload_url="{{ route('images.upload.news') }}" />
    <style>
        .select2-selection__rendered,  .select2-results {
            font-family: "fontAwesome";
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header py-1">
            <div class="h4 my-1">
                <button class="border-0 bg-transparent" onclick="history.back()">
                    <</button>
                        Buat Layanan
            </div>
        </div>
        <div class="card-body">
            <form method='POST' action="{{ route('layanan.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="icon" class="form-label">Ikon</label>
                    <x-select-icon name='icon' className="form-select" />
                    @error('icon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Layanan</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Deskripsi Singkat</label>
                    <input type="text" name="description" id="description" class="form-control" required>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Detil Layanan</label>
                    <textarea name="detail" id="edit-detail" cols="30" rows="10" class="form-control"></textarea>
                    @error('detail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('select[name=icon]').select2();
    </script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: `{{ session()->get('success') }}`,
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @elseif(session()->has('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: `Gagal mengubah berita`,
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
