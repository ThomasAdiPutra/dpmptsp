@extends('layout.master', ['title'=>'Kontak DPMPTSP'])

@section('head')
    <style>
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
    </style>
@endsection

@section('main')
    <div id="contact" class="wow fadeInUp">
        <div class="section-header">
            <h3>Lokasi Kami</h3>
        </div>
        <div class="">
            <iframe width="100%" height="500px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?q={{ $contact['lat']->value }},{{ $contact['lon']->value }}&output=embed"></iframe>
        </div>
        <div class="row contact-info pt-4">
            <div class="col-md-4">
                <div class="contact-address">
                    <i class="fa fa-map-marker"></i>
                    <h3>Address</h3>
                    <address>{{ $contact['alamat']->value }}</address>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-phone">
                    <i class="fa fa-phone"></i>
                    <h3>Phone Number</h3>
                    <p><a href="tel:{{ $contact['no_hp']->value }}">{{ $contact['no_hp']->value }}</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-email">
                    <i class="fa fa-envelope"></i>
                    <h3>Email</h3>
                    <p><a href="mailto:{{ $contact['email']->value }}">{{ $contact['email']->value }}</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
