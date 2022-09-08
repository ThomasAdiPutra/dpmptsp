<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/img/logo.png') }}">
    <!-- App css -->
    <link href="{{ asset('asset/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{ asset('asset/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    @yield('head')
</head>

<!-- body start -->

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid"
    data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
    data-sidebar-user='true'>

    <!-- Begin page -->
    <div id="wrapper">
        @include('layout.partials.topbar')
        @include('layout.partials.sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <div class="container-fluid">@yield('content')</div>

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('layout.partials.footer')
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    @include('layout.partials.rightbar')
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor -->
    <script src="{{ asset('asset/admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('asset/admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('asset/admin/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/admin/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('asset/admin/libs/feather-icons/feather.min.js') }}"></script>

    <!-- knob plugin -->
    <script src="{{ asset('asset/admin/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('asset/admin/js/app.js') }}"></script>
    @yield('script')
</body>

</html>
