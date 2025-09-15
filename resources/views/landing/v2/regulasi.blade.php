@extends('layouts.landing.v2.master')

@section('title', 'Web Kemenag Kanwil Prov Sumbar - Contact')

@section('_styles')

{{-- Primary Meta Tags --}}
<meta name="title" content="{{$title}}">
<meta name="description" content="{{$title}}" />
<meta name="keywords" content="PPID, PPID Kementerian Agama, Web Kemenag Kanwil Prov Sumbar, Komisi Informasi" />
<meta name="author" content="Web Kemenag Kanwil Prov Sumbar" />
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<meta name="revisit-after" content="1 Days" />

<!-- Open Graph / Facebook -->
<meta property="og:site_name" content="{{$title}}">
<meta property="og:title" content="{{$title}}">
<meta property="og:locale" content="id_ID">
<meta property="og:description" content="Web - {{$title}}">
<meta property="og:image" content="{{ asset('sailor/img/logo.png') }}" />

<meta property="og:type" content=website />
<meta property="og:url" content="{{ URL::current() }}" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="{{$title}}" />
<meta name="twitter:title" content="{{$title}}" />
<meta name="twitter:description" content="Web - {{$title}}">
<meta name="twitter:image" content="{{ asset('sailor/img/logo.png') }}" />
<meta property="twitter:url" content="{{ URL::current() }}">


<link rel="canonical" href="{{ URL::current() }}" />
<link rel="alternate" hreflang="en-US" href="{{ URL::current() }}" />
<link rel="shortcut icon" type="image/png" href="{{ URL::current() }}" />
@endsection

@section('content')

<hr class="pt-0 mt-0">

<!-- START SECTION CONTACT -->
<section class="wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
    <div class="container">
        <h3>Regulasi</h3>
        <h4>Peraturan</h4><br>
        <div class="row">
            <div class="col-12">
                <p>Daftar peraturan terkait Keterbukaan Informasi Publik:</p>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <table class="table table-bordered" style="font-size:1.1rem;">
                            <tbody>
                                <tr>
                                    <td>Undang-Undang (UU) Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</td>
                                    <td align="center"><a
                                            href="https://ppid.kemenag.go.id/v3/files/60UU_No_14_Tahun_2008_tentang_KIP.pdf"
                                            target="_blank" class="badge badge-primary badge-sm">link</a></td>
                                </tr>
                                <tr>
                                    <td>Peraturan Pemerintah (PP) No 61 Tahun 2010 tentang Pelaksanaan Undang - Undang
                                        Keterbukaan Informasi Publik</td>
                                    <td align="center"><a
                                            href="https://ppid.kemenag.go.id/v3/files/12Nomor_61_Tahun_2010_Keterbukaan_Informasi_Publik.pdf"
                                            target="_blank" class="badge badge-primary badge-sm">link</a></td>
                                </tr>
                                <tr>
                                    <td>Peraturan Komisi Informasi (PERKI) Nomor I Tahun 2021 tentang Standar Layanan
                                        Informasi Publik (SLIP)</td>
                                    <td align="center"><a
                                            href="https://ppid.kemenag.go.id/v3/files/PerKIP 1 Tahun 2021 SLIP.pdf"
                                            target="_blank" class="badge badge-primary badge-sm">link</a></td>
                                </tr>
                                <tr>
                                    <td>Peraturan Komisi Informasi (PERKI) Nomor 1 Tahun 2013 tentang Prosedur
                                        Penyelesaian Sengketa Informasi Publik</td>
                                    <td align="center"><a
                                            href="https://ppid.kemenag.go.id/v3/files/40Perki_No.1_Tahun_2013_.pdf"
                                            target="_blank" class="badge badge-primary badge-sm">link</a></td>
                                </tr>
                                <tr>
                                    <td>Peraturan Mahkamah Agung RI (Perma) Nomor 2 Tahun 2011 tentang Tata Cara
                                        Penyelesaian Sengketa Informasi Publik di Pengadilan</td>
                                    <td align="center"><a
                                            href="https://ppid.kemenag.go.id/v3/files/6perma-no-2-tahun-2011-tentang-tata-cara-penyelesaian-sengketa-informasi-publik-pengadilan.pdf"
                                            target="_blank" class="badge badge-primary badge-sm">link</a></td>
                                </tr>
                                <tr>
                                    <td>Keputusan Menteri Agama (KMA) Nomor 92 Tahun 2019 tentang Pedoman Layanan
                                        Informasi Publik Bagi Pejabat Pengelola Informasi dan Dokumentasi Kementerian
                                        Agama dan Atasan Pejabat Pengelola Informasi dan Dokumentasi Kementerian Agama
                                    </td>
                                    <td align="center"><a
                                            href="https://ppid.kemenag.go.id/v3/files/33kma-92-2019-pedoman-layanan-publik-ppid-atasan-ppid.pdf"
                                            target="_blank" class="badge badge-primary badge-sm">link</a></td>
                                </tr>
                                <tr>
                                    <td>Keputusan Menteri Agama Nomor 657 Tahun 2021 tentang PPID Kementerian Agama dan
                                        Atasan PPID Kementerian Agama</td>
                                    <td align="center"><a
                                            href="https://ppid.kemenag.go.id/v3/files/Keputusan Menteri Agama Nomor 657 Tahun 2021 tentang PPID Kementerian Agama dan Atasan PPID Kementerian Agama.pdf"
                                            target="_blank" class="badge badge-primary badge-sm">link</a></td>
                                </tr>
                                {{-- <tr>
                                    <td colspan="2">
                                        <div class="panel-heading">
                                            <div class="panel-title"> <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapse1">Perjanjian Kinerja</a> </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div id="collapse1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <table width="100%" style="font-size:1.1rem;">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="panel-heading">
                                                                    <div class="panel-title"> <a data-toggle="collapse"
                                                                            data-parent="#accordion"
                                                                            href="#collapse2">Menteri Agama</a> </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse2" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>  1. Tahun 2022</td>
                                                                                    <td align="center"><a
                                                                                            href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/PERKIN%20MENTERI%20AGAMA%202022.pdf"
                                                                                            target="_blank"
                                                                                            class="badge badge-primary badge-sm">link</a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>  2. Tahun 2021</td>
                                                                                    <td align="center"><a
                                                                                            href="https://ppid.kemenag.go.id/v3/files/Perkin Menag 2021.pdf"
                                                                                            target="_blank"
                                                                                            class="badge badge-primary badge-sm">link</a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse3">Sekretariat
                                                                                                    Jenderal</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse3"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/SETJEN.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse4">Inspektorat
                                                                                                    Jenderal</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse4"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/ITJEN.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse5">Direktorat
                                                                                                    Jenderal Pendidikan
                                                                                                    Islam</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse5"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/PENDIS.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse6">Direktorat
                                                                                                    Jenderal
                                                                                                    Penyelenggaraan Haji
                                                                                                    dan Umrah</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse6"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/PHU.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse7">Direktorat
                                                                                                    Jenderal Bimas
                                                                                                    Islam</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse7"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/BIMAS ISLAM.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse7">Direktorat
                                                                                                    Jenderal Bimas
                                                                                                    Kristen</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse7"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/KRISTEN.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse8">Direktorat
                                                                                                    Jenderal Bimas
                                                                                                    Katolik</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse8"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/KRISTEN.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse9">Direktorat
                                                                                                    Jenderal Bimas
                                                                                                    Hindu</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse9"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse10">Direktorat
                                                                                                    Jenderal Bimas
                                                                                                    Buddha</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse10"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/BUDDHA.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse11">Badan
                                                                                                    Litbang dan
                                                                                                    Diklat</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse11"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <table width="100%" style="font-size:1.1rem;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div class="panel-heading">
                                                                                            <div class="panel-title"> <a
                                                                                                    data-toggle="collapse"
                                                                                                    data-parent="#accordion"
                                                                                                    href="#collapse12">Badan
                                                                                                    Penyelenggara
                                                                                                    Jaminan Produk
                                                                                                    Halal</a> </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <div id="collapse12"
                                                                                            class="panel-collapse collapse in">
                                                                                            <div class="panel-body">
                                                                                                <table width="100%"
                                                                                                    style="font-size:1.1rem;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>  1.
                                                                                                                Tahun
                                                                                                                2022
                                                                                                            </td>
                                                                                                            <td
                                                                                                                align="center">
                                                                                                                <a href="https://cms.kemenag.go.id/storage/flm/files/shares/files/perkin/BPJPH.pdf"
                                                                                                                    target="_blank"
                                                                                                                    class="badge badge-primary badge-sm">link</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <br><br>
        <h4>Rancangan Peraturan</h4><br>
        <div class="row">
            <div class="col-12">
                <p>Daftar rancangan peraturan terkait Keterbukaan Informasi Publik:</p>
                <table class="table table-bordered" style="font-size:1.1rem;">
                    <tbody>
                        <tr>
                            <td>Rancangan Keputusan Menteri Agama Republik Indonesia tentang Pejabat Pengelola Informasi
                                dan Dokumentasi Kementerian Agama dan Atasan Pejabat Pengelola Informasi dan Dokumentasi
                            </td>
                            <td align="center"><a
                                    href="https://ppid.kemenag.go.id/v3/files/64Draft-KMA-PPID-dan-Atasan-PPID-Kemenag.pdf"
                                    target="_blank" class="badge badge-primary badge-sm">link</a></td>
                        </tr>
                        <tr>
                            <td>Rancangan Keputusan Menteri Agama Republik Indonesia tentang Pedoman Layanan Informasi
                                Publik Bagi Pejabat Pengelola Informasi dan Dokumentasi Kementerian Agama dan Atasan
                                Pejabat Pengelola Informasi dan Dokumentasi Kementerian Agama</td>
                            <td align="center"><a
                                    href="https://ppid.kemenag.go.id/v3/files/22018-12-06-Draft KMA ttg Pedoman Layanan Informasi Publik di Kemenag-edit final sblm ke rohukum.pdf"
                                    target="_blank" class="badge badge-primary badge-sm">link</a></td>
                        </tr>
                    </tbody>
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