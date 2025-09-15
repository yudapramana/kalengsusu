@extends('layouts.landing.v2.master')

@section('title', 'Web Kemenag Kanwil Prov Sumbar - Contact')

@section('_styles')

    {{-- Primary Meta Tags --}}
    <meta name="title" content="{{ $title }}">
    <meta name="description" content="{{ $title }}" />
    <meta name="keywords" content="PPID, PPID Kementerian Agama, Web Kemenag Kanwil Prov Sumbar, Komisi Informasi" />
    <meta name="author" content="Web Kemenag Kanwil Prov Sumbar" />
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <meta name="revisit-after" content="1 Days" />

    <!-- Open Graph / Facebook -->
    <meta property="og:site_name" content="{{ $title }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:description" content="Web - {{ $title }}">
    <meta property="og:image" content="{{ asset('sailor/img/logo.png') }}" />

    <meta property="og:type" content=website />
    <meta property="og:url" content="{{ URL::current() }}" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ $title }}" />
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="Web - {{ $title }}">
    <meta name="twitter:image" content="{{ asset('sailor/img/logo.png') }}" />
    <meta property="twitter:url" content="{{ URL::current() }}">

    <link rel="canonical" href="{{ URL::current() }}" />
    <link rel="alternate" hreflang="en-US" href="{{ URL::current() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ URL::current() }}" />
@endsection

@section('content')

    <hr class="pt-0 mt-0">

    <!-- START SECTION CONTACT -->

    <section id="contact" class="pt-0 pb-5 m-0">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-sm-start">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item  active  " aria-current="page">
                                Ringkasan Total Berita Daerah Tahun {{ $year }}
                            </li>
                        </ol>
                    </nav>
                    <div class="page-title">
                        <h1 class="greenext" style="border-bottom: 2px solid #dae0e5 !important;">Ranking Total Berita Daerah Tahun {{ $year }}
                        </h1>
                    </div>
                </div>

                <div class="col-sm-12 p-3 m-3">
                    <table class="table responsive-table">
                        <tr>
                            <th>No</th>
                            <th>Kabupaten/Kota</th>
                            <th>Total Berita</th>
                        </tr>

                        @foreach ($posts as $key => $kabkota)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $kabkota->name }}</td>
                                <td>{{ $kabkota->total }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </section>
    <!-- END SECTION CONTACT -->


@endsection


@section('_scripts')
    {{-- No Data --}}
@endsection
