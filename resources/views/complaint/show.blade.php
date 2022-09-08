@extends('layout.master', ['title' => 'Pengaduan DPMPTSP'])

@section('head')
    <style>
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

@section('main')
    <div class="mr-1">
        <div class="card">
            <div class="card-body">
                <div>
                    <span class="float-left">{{ $pengaduan->name }}</span>
                    <span class="float-right">{{ date('H:i:s d M Y', strtotime($pengaduan->created_at)) }}</span>
                </div><br>
                <div class="my-3">
                    <div class="h4 py-1 mb-2 border-bottom">{{ $pengaduan->judul_aduan }}</div>
                    <div class="h5">{{ $pengaduan->isi_aduan }}</div>
                </div>
            </div>
        </div>
        @forelse ($pengaduan->reply->sortBy('created_at') as $reply)
            <div class="reply row mr-0">
                <div class="return-symbol col-3 col-sm-2 col-md-1 col-lg-1">&#x23CE;</div>
                <div class="card col-9 col-sm-10 col-md-11 col-lg-11 reply-content">
                    <div class="card-body">
                        <div>
                            <span class="float-left">{{ $reply->user->name }}</span>
                            <span class="float-right">{{ date('H:i:s d M Y', strtotime($reply->created_at)) }}</span>
                        </div><br>
                        <div class="border p-2 h5">{{ $reply->reply }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card mt-2">
                <div class="card-body">
                    <div class="text-muted text-center h4">Tidak ada jawaban</div>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@section('script')
@endsection
