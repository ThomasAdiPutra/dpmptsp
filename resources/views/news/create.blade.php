@extends('layout.master-admin', ['title'=>'Berita'])
@section('head')
    <x-head.tinymce-config images_upload_url="{{ route('images.upload.news') }}" />
@endsection

@section('content')
    <div class="card">
        <div class="card-header py-1">
            <div class="h4 my-1">
                <button class="border-0 bg-transparent" onclick="history.back()">
                    <</button>
                        Buat Berita
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('berita.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-2">
                        <label for="category" class="form-label">Kategori</label>
                        <select id="category" class="form-select" name="category_id" required>
                            <option></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12 col-md-9 my-2">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail / Gambar</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="form-control" required>
                    @error('thumbnail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content">Konten Berita</label>
                    <textarea name='content' id="content"></textarea>
                    @error('content')
                        {{ $message }}
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                title: `Gagal membuat berita`,
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
