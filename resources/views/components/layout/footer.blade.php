<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>DPMPTSP</h3>
                    <p>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Ketapang.</p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Link Terkait</h4>
                    <ul>
                        @foreach ($related_links as $related_link)
                            <li><i class="ion-ios-arrow-right"></i> <a
                                    href="{{ $related_link->link }}">{{ $related_link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-map">
                    <h4>Lokasi Kami</h4>
                    <iframe width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{$contacts['lat']->value}},{{$contacts['lon']->value}}&hl=es;z=14&output=embed">
                    </iframe>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Kontak Kami</h4>
                    <p class="h6">
                        <i class="fa fa-home pr-2"></i>{{ $contacts['alamat']->value }}<br/>
                        <i class="fa fa-phone pr-2 py-2"></i>{{ $contacts['no_hp']->value }}<br/>
                        <i class="fa fa-envelope pr-2"></i>{{ $contacts['email']->value }}
                    </p>

                    <div class="social-links">
                        <a href="https://wa.me/{{ $contacts['whatsapp']->value }}" class="whatsapp"><i class="fa fa-whatsapp"></i></a>
                        <a href="{{ $contacts['facebook']->value }}" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $contacts['instagram']->value }}" class="instagram"><i class="fa fa-instagram"></i></a>
                        <a href="{{ $contacts['youtube']->value }}}" class="youtube"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong>{{ env('APP_NAME') }}</strong>. All Rights Reserved
        </div>
    </div>
</footer>
