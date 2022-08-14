<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{ asset('customer/img/favicon.png') }}" type="image/png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eiser | @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendors/linericon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendors/lightbox/simpleLightbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendors/nice-select/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendors/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/css/toastr.min.css') }}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('customer/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/css/responsive.css') }}" />
</head>

<body>
    @include('client.layouts.header')
    @yield('wrapper')
    @include('client.layouts.footer')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('customer/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('customer/js/popper.js') }}"></script>
    <script src="{{ asset('customer/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customer/js/stellar.js') }}"></script>
    <script src="{{ asset('customer/vendors/lightbox/simpleLightbox.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/isotope/isotope-min.js') }}"></script>
    <script src="{{ asset('customer/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/counter-up/jquery.counterup.js') }}"></script>
    <script src="{{ asset('customer/js/mail-script.js') }}"></script>
    <script src="{{ asset('customer/js/theme.js') }}"></script>
    <script src="{{ asset('customer/js/toastr.min.js') }}"></script>
    @yield('script')
</body>

</html>
