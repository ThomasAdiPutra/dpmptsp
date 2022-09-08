@extends('layout.master-admin', ['title' => 'Tentang'])
@section('head')
    <x-head.tinymce-config images_upload_url="{{ route('images.upload.news') }}" selector='#profil' />
    <x-head.tinymce-config images_upload_url="{{ route('images.upload.news') }}" selector='#misi' script='false' />
    <x-head.tinymce-config images_upload_url="{{ route('images.upload.news') }}" selector='#fungsi' script='false' />
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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="logo-tab" data-bs-toggle="tab" data-bs-target="#logo"
                        type="button" role="tab" aria-controls="logo" aria-selected="true">Logo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="struktur-organisasi-tab" data-bs-toggle="tab"
                        data-bs-target="#struktur-organisasi" type="button" role="tab"
                        aria-controls="struktur-organisasi" aria-selected="true">Struktur Organisasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button"
                        role="tab" aria-controls="profil" aria-selected="false">Profil</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="visi-misi-tab" data-bs-toggle="tab" data-bs-target="#visi-misi"
                        type="button" role="tab" aria-controls="visi-misi" aria-selected="false">Visi Misi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="maklumat-pelayanan-tab" data-bs-toggle="tab"
                        data-bs-target="#maklumat-pelayanan" type="button" role="tab"
                        aria-controls="maklumat-pelayanan" aria-selected="false">Maklumat
                        Pelayanan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tupoksi-tab" data-bs-toggle="tab" data-bs-target="#tupoksi" type="button"
                        role="tab" aria-controls="tupoksi" aria-selected="false">Tupoksi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sop-tab" data-bs-toggle="tab" data-bs-target="#sop" type="button"
                        role="tab" aria-controls="sop" aria-selected="false">SOP</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                    <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="img-thumbnail mb-3"><img src="{{ $about['logo']->value }}" alt="Logo"
                                class="img-fluid"></div>
                        <div class="mb-2">
                            <label for="" class="form-label">Logo</label>
                            <input type="file" name="logo" id="" accept="image/*" class="form-control" required>
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="struktur-organisasi" role="tabpanel"
                    aria-labelledby="struktur-organisasi-tab">
                    <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="img-thumbnail mb-3"><img src="{{ $about['struktur_organisasi']->value }}"
                                alt="struktur organisasi" class="img-fluid"></div>
                        <div class="mb-2">
                            <label for="" class="form-label">Struktur Organisasi</label>
                            <input type="file" name="struktur_organisasi" id="" accept="image/*"
                                class="form-control" required>
                            @error('struktur_organisasi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                    <form action="{{ route('about.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="" class="form-label">Profil</label>
                            <textarea name="profil" id="profil" cols="30" rows="12">{{ $about['profil']->value }}</textarea>
                            @error('profil')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="visi-misi" role="tabpanel" aria-labelledby="visi-misi-tab">
                    <form action="{{ route('about.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="" class="form-label">Visi</label>
                            <input type="text" name="visi" id="" value="{{ $about['visi']->value }}"
                                class="form-control" required>
                            @error('visi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Misi</label>
                            <textarea name="misi" id="misi" cols="30" rows="10">{{ $about['misi']->value }}</textarea>
                            @error('misi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="maklumat-pelayanan" role="tabpanel"
                    aria-labelledby="maklumat-pelayanan-tab">
                    <form action="{{ route('about.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="" class="form-label">Maklumat Pelayanan</label>
                            <input type="text" name="maklumat_pelayanan" id=""
                                value="{{ $about['maklumat_pelayanan']->value }}" class="form-control" required>
                            @error('maklumat_pelayanan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="tupoksi" role="tabpanel" aria-labelledby="tupoksi-tab">
                    <form action="{{ route('about.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="" class="form-label">Tugas Pokok</label>
                            <input type="text" name="tugas_pokok" id=""
                                value="{{ $about['tugas_pokok']->value }}" class="form-control" required>
                            @error('tugas_pokok')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Fungsi</label>
                            <textarea name="fungsi" id="fungsi" cols="30" rows="10">{{ $about['fungsi']->value }}</textarea>
                            @error('fungsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="sop" role="tabpanel" aria-labelledby="sop-tab">
                    <div class="mb-2">
                        <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mb-2">
                                <label for="" class="form-label">SOP</label>
                                <input type="file" name="sop" id="sop" accept="application/pdf"
                                    class="form-control" required>
                                @error('sop')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <object data="{{ $about['sop']->value }}" type="application/pdf" style="width: 100%; height:500px;">
                        <a href="{{ $about['sop']->value }}" download>SOP</a>
                    </object>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
