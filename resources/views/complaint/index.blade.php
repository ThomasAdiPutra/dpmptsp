@extends('layout.master', ['title' => 'Pengaduan DPMPTSP'])

@section('head')
    <style>
        /* Call To Action Section
        --------------------------------*/

        #call-to-action {
            background: linear-gradient(rgba(215, 187, 187, 0.5), rgba(0, 0, 0, 0.6)), url('/asset/img/lapor-bg.jpg') fixed center center;
            background-size: cover;
            padding: 60px 0;
        }

        #call-to-action h3 {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
        }

        #call-to-action p {
            color: #fff;
        }

        #call-to-action .cta-btn {
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
            font-weight: 500;
            font-size: 16px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 8px 28px;
            border-radius: 25px;
            transition: 0.5s;
            margin-top: 10px;
            border: 2px solid #fff;
            color: #fff;
        }

        #call-to-action .cta-btn:hover {
            background: #18d26e;
            border: 2px solid #18d26e;
        }

        #contact {
            padding: 60px 0;
        }

        #contact .contact-info {
            margin-bottom: 20px;
            text-align: center;
        }

        #contact .contact-info i {
            font-size: 48px;
            display: inline-block;
            margin-bottom: 10px;
            color: #18d26e;
        }

        #contact .contact-info address,
        #contact .contact-info p {
            margin-bottom: 0;
            color: #000;
        }

        #contact .contact-info h3 {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: bold;
            text-transform: uppercase;
            color: #999;
        }

        #contact .contact-info a {
            color: #000;
        }

        #contact .contact-info a:hover {
            color: #18d26e;
        }

        #contact .contact-address,
        #contact .contact-phone,
        #contact .contact-email {
            margin-bottom: 20px;
        }

        #contact .form input,
        #contact .form textarea {
            padding: 10px 14px;
            border-radius: 0;
            box-shadow: none;
            font-size: 15px;
        }

        #contact .form button[type="submit"] {
            background: #18d26e;
            border: 0;
            padding: 10px 30px;
            color: #fff;
            transition: 0.4s;
            cursor: pointer;
        }

        #contact .form button[type="submit"]:hover {
            background: #13a456;
        }

        .complaint:hover {
            cursor: pointer;
        }
    </style>
@endsection

@section('main')
    <section id="call-to-action" class="wow fadeIn">
        <div class="container text-center">
            <h3>Portal SP4N-Lapor</h3>
            <h3>Masyarakat Ketapang tidak boleh takut melaporkan pelanggaran</h3>
            <a class="cta-btn" target="_BLANK" href="https://lapor.go.id"><i
                    class="fa fa-exclamation-triangle pr-2"></i>Lapor</a>
        </div>
    </section>
    <div id="contact" class="wow fadeInUp">
        <h3>Layanan Pengaduan Online</h3>
        <div class="form">
            <form action="{{ route('pengaduan.store') }}" method="POST" role="form" class="complaintForm">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda"
                            value="{{ old('name') }}" required />
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda"
                            value="{{ old('email') }}" required />
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat Anda"
                            value="{{ old('alamat') }}" required />
                        @error('alamat')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No HP Anda"
                            value="{{ old('no_hp') }}" required />
                        @error('no_hp')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="judul_aduan" id="judul_aduan"
                        value="{{ old('judul_aduan') }}" placeholder="Judul Pengaduan" required />
                    @error('judul_aduan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="isi_aduan" rows="5" placeholder="Isi Aduan" required>{{ old('isi_aduan') }}</textarea>
                    @error('isi_aduan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
        </div>

        <div class="complaints row mt-4">
            <div class="col-12">
                <div class="px-3">
                    @forelse ($complaints as $complaint)
                        <div class="row border-bottom border-blue py-2 complaint" id="{{ $complaint->id }}">
                            <div class="col-sm-2 text-center">
                                <img src="{{ asset('asset/img/profile/default.png') }}"
                                    class="img-thumbnail rounded-circle">
                            </div>
                            <div>
                                <div class="list-group-item-text pb-2">{{ $complaint->name }} -
                                    {{ date('d M Y', strtotime($complaint->created_at)) }} : </div>
                                <div class="list-group-item-text">"{{ Str::words($complaint->isi_aduan, 10) }}"</div>
                                @if (!$complaint->reply->isEmpty())
                                    <div class="pt-2">Jawaban :
                                        <b>{{ $complaint->reply->first()->user->name }}</b>
                                    </div>
                                    <span class="list-group-item-text">
                                        "{{ Str::words($complaint->reply->first()->reply, 10) }}"
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="h3">Tidak ada pengaduan</div>
                    @endforelse
                    <div class="float-right pt-3">
                        {{ $complaints->links('components.pagination.links', ['paginator' => $complaints]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.complaint').on('click', function() {
            let id = $(this).attr('id');
            window.location.href = `{{ url('/pengaduan') }}/${id}`
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
