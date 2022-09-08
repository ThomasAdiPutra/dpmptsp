@extends('layout.master-admin', ['title' => 'Pengaduan'])

@section('head')
    <style>
        .input-container {
            position: relative;
        }

        .input-container input {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
        }

        .input-container button {
            position: absolute;
            height: 100%;
            top: 0;
            right: 0;
        }

        .return-symbol {
            -moz-transform: scale(-1, 11);
            -o-transform: scale(-1, 1);
            -webkit-transform: scale(-1, 1);
            transform: scale(-1, 1);
            font-size: 45px;
        }

        .card {
            margin-bottom: 0 !important;
        }

        .reply-content {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="me-1">
        <div class="card">
            <div class="card-body">
                <div>
                    <span class="float-start">{{ $pengaduan->name }}</span>
                    <span class="float-end">{{ date('H:i:s d M Y', strtotime($pengaduan->created_at)) }}</span>
                </div><br>
                <div class="my-3">
                    <div class="h4 py-1 mb-2 border-bottom">{{ $pengaduan->judul_aduan }}</div>
                    <div class="h5">{{ $pengaduan->isi_aduan }}</div>
                </div>
                <div>
                    <form action="{{ route('pengaduan.reply') }}" method="POST">
                        @csrf
                        <div class="input-container">
                            <input type="hidden" name="complaint_id" value="{{ $pengaduan->id }}">
                            <input type="text" name="reply" class="form-control" placeholder="Jawaban..." required>
                            @error('reply')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @forelse ($pengaduan->reply->sortBy('created_at') as $reply)
            <div class="reply row me-0">
                <div class="return-symbol col-3 col-sm-2 col-md-1 col-lg-1">&#x23CE;</div>
                <div class="card col-9 col-sm-10 col-md-11 col-lg-11 reply-content">
                    <div class="card-body">
                        <div>
                            <span class="float-start">{{ $reply->user->name }}</span>
                            <span class="float-end">{{ date('d M Y', strtotime($reply->created_at)) }}</span>
                        </div><br>
                        <div class="border p-2 h5">{{ $reply->reply }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card mt-2">
                <div class="card-body">
                    <div class="text-muted text-center h4">Tidak ada komentar</div>
                </div>
            </div>
        @endforelse
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
