@extends('layout.master-admin', ['title' => 'Kontak'])
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
    <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
    <style>
        #map {
            width: 100%;
            height: 380px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kontak.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ $contact['email']->value }}"
                        class="form-control" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="no-hp" class="form-label">No HP</label>
                            <input type="text" name="no_hp" id="no-hp" value="{{ $contact['no_hp']->value }}"
                                class="form-control" required>
                            @error('no_hp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="no-hp" class="form-label">Whatsapp</label>
                            <input type="text" name="whatsapp" id="no-hp" value="{{ $contact['whatsapp']->value }}"
                                class="form-control" required>
                            @error('whatsapp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" name="facebook" id="facebook" value="{{ $contact['facebook']->value }}"
                        class="form-control" required>
                    @error('facebook')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" name="instagram" id="instagram" value="{{ $contact['instagram']->value }}"
                        class="form-control" required>
                    @error('instagram')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="youtube" class="form-label">Youtube</label>
                    <input type="text" name="youtube" id="youtube" value="{{ $contact['youtube']->value }}"
                        class="form-control" required>
                    @error('youtube')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" required>{{ $contact['alamat']->value }}</textarea>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="lat" value="{{ $contact['lat']->value }}" required>
                <input type="hidden" name="lon" value="{{ $contact['lon']->value }}" required>
                <div class="mb-3">
                    <div id="map"></div>
                    @error('lat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('lon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var map = L.map('map', {
            center: [{{ $contact['lat']->value }}, {{ $contact['lon']->value }}],
            zoom: 13,
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker = L.marker([{{ $contact['lat']->value }}, {{ $contact['lon']->value }}]).addTo(map);
        map.on('click', (e) => {
            var {
                lat,
                lng
            } = e.latlng;
            var newLatLng = new L.LatLng(lat, lng);
            marker.setLatLng(newLatLng);
            map.panTo(newLatLng, {
                animate: true,
                duration: 1,
            });
            $('input[name=lat]').val(lat);
            $('input[name=lon]').val(lng);
        });

        L.easyButton('fa-map-marker', function(btn, map) {
            var lat = {{ $contact['lat']->value }};
            var lng = {{ $contact['lon']->value }};
            var currentLatLng = new L.LatLng(lat, lng);
            marker.setLatLng(currentLatLng);
            $('input[name=lat]').val(lat);
            $('input[name=lon]').val(lng);
            map.panTo(currentLatLng, {
                animate: true,
                duration: 1,
            });
        }).addTo(map);
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
