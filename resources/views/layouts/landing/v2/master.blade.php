<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Anil z" name="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Selamat datang di halaman Web Utama Kantor Wilayah Kementerian Agama Provinsi Sumatera Barat.">
    <meta name="keywords"
        content="Web, Pusat Informasi dan Dokumentasi, Kementerian Agama, Kabupaten Pesisir Selatan, informasi, dokumen, data, layanan, program, kebijakan, berita, transparansi.">

    <!-- SITE TITLE -->
    <title>@yield('title')</title>

    <!-- SITE STYLES -->
    @include('layouts.landing.v2.styles')

    @yield('_styles')

</head>

<body>

    <!-- LOADER -->
    <div class="preloader">
        <div class="loader_grid">
            <div class="loader_box loader_box1"></div>
            <div class="loader_box loader_box2"></div>
            <div class="loader_box loader_box3"></div>
            <div class="loader_box loader_box4"></div>
            <div class="loader_box loader_box5"></div>
            <div class="loader_box loader_box6"></div>
            <div class="loader_box loader_box7"></div>
            <div class="loader_box loader_box8"></div>
            <div class="loader_box loader_box9"></div>
        </div>
    </div>
    <!-- END LOADER -->

    <!-- START HEADER -->
    @include('layouts.landing.v2.header')
    <!-- END HEADER -->

    <!-- START MAIN CONTENT -->
    @yield('content')
    <!-- END   MAIN CONTENT -->

    <!-- START FOOTER SECTION -->
    @include('layouts.landing.v2.footer')
    <!-- END FOOTER SECTION -->

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

    <!-- SITE SCRIPTS -->
    @include('layouts.landing.v2.scripts')

</body>

</html>