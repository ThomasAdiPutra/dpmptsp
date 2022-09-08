@extends('layout.master-admin', ['title'=>'Berita'])
@section('head')
    <x-head.tinymce-config images_upload_url="{{ route('images.upload.news') }}" />
@endsection

@section('content')
    <div class="card">
        <div class="card-header py-1">
            <div class="h4 my-1">
                <button class="border-0 bg-transparent" onclick="history.back()"><</button>
                Edit Berita
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('berita.update', ['beritum' => $news->slug]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-2">
                        <label for="category" class="form-label">Kategori</label>
                        <select id="category" class="form-select" name="category_id" required>
                            <option></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $news->category_id ? 'selected' : '' }}>
                                    {{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12 col-md-9 my-2">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" value="{{ $news->title }}" class="form-control" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mt-3 mb-1">
                        <img src="{{ $news->thumbnail }}" alt="{{ $news->title }}" style="max-width: 300px;"
                            width="100%;">
                    </div>
                    <label for="thumbnail" class="form-label">Thumbnail / Gambar</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="form-control">
                    @error('thumbnail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content">Konten Berita</label>
                    <textarea name='content' id="content">{{ $news->content }}</textarea>
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
                title: `Gagal mengubah berita`,
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
