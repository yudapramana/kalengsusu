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

<style>
    .greenext {
        color: #29b477;
        font-weight: 600;
        letter-spacing: 1px;
    }
</style>
@endsection

@section('content')

<hr class="pt-0 mt-0">

<section class="p-0 m-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="p-0 m-0">

                    <div class="row">
                        <div class="col-sm-12 pt-5 pb-3 wow fadeInLeft animated">

                            <h4 class="greenext"> {{ $sect }}</h4>

                        </div>


                    </div>
                </section>

                <section id="features" class="pt-0 mt-0">

                    <!--Section heading-->
                    {{-- <h1 class="mt-5 pt-3 dark-grey-text wow fadeIn text-center" data-wow-delay="0.2s"><strong
                            class="font-weight-bold">Data & Informasi</strong> Publik</h1>
                    <hr class="grey mt-0 d-inline-block mx-auto" style="width: 100%;"> --}}
                    <!--Section description-->


                    <div class="row features wow fadeIn" data-wow-delay="0.2s">
                        <form role="form" id="search-form" autocomplete="off" style="width:100%">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_data_klasifikasi" id="id_data_klasifikasi"
                                value="{{ $id_data_klasifikasi }}">
                            <div class="form-group col-sm-12">
                                <label>Judul/Deskripsi</label>
                                <input placeholder="Judul/Deskripsi" class="form-control" name="search" id="search"
                                    type="text">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Instansi / Seksi</label>
                                <div class="custome_select">
                                    <select class="form-control" name="id_data_seksi" id="id_data_seksi">
                                        <option value="" selected="selected">-- Semua --</option>
                                        @foreach ($instansi_s as $data)
                                        <option value="{{ $data->id_data_instansi }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <div class="chek-form mb-3">
                                    <button type="button" class="btn btn-default btn-aylen mb-2 btn-sm"
                                        id="search-button">Cari
                                        Data <i class="ti-info-alt"></i></button>
                                    <button type="button" class="btn btn-danger btn-aylen mb-2 btn-sm"
                                        id="refresh-button">Refresh
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--First row-->
                    <div class="row features wow fadeIn" data-wow-delay="0.2s">

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="defTbl" class="table dataTable dtr-inline">
                                    <thead class="text-center">
                                        <th>No</th>
                                        <th>Judul / Keterangan</th>
                                        <th>Instansi / Seksi - Kategori</th>
                                        <th>Klasifikasi</th>
                                        <th>Tahun & Tempat</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Hits / Download</th>
                                    </thead>
                                    <tbody class="container-data">
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-footer text-center col-sm-12 col-md-12">
                            </div>

                        </div>

                    </div>
                    <!--/First row-->

                </section>
            </div>
        </div>
    </div>
</section>





@endsection


@section('_scripts')

<!-- BlockUI -->
<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>

<script>
    // $(function() {
    //     'use strict';


        var url = "{{ route('data.all') }}";

        //Animation init
        // new WOW().init();

        //Modal
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').focus()
        })

        // $(document).on('submit', '#search-form', function(event){
        //     event.preventDefault();
        //     url = "{{ route('data.all') }}";
        //     loadData();
        // });

        // $('#search-form').submit(function(e) {
        //     e.preventDefault();
        //     url = "{{ route('data.all') }}";
        //     loadData();
        // });

        $('#search-button').click(function(e) {
            console.log('aaaa');
            e.preventDefault();
            url = "{{ route('data.all') }}";
            loadData();
        });

        $('#refresh-button').click(function(e) {
            console.log('aaaa');
            e.preventDefault();
            $('#search-form')[0].reset();
            url = "{{ route('data.all') }}";
            loadData();
        });

        $(document).ready(function() {
            url = "{{ route('data.all') }}";
            loadData();
        });

        $(document).ajaxStart(function() {
            $('#defTbl').block({
                message: `Loading...`
            });
        });

        // Data
        function loadData() {
            var searchdata = $("#search-form").serialize();
            var formdata = $("#filter-form").serialize() + "&" + searchdata;


            $.ajax({
                type: 'POST',
                url: url,
                data: formdata, // here $(this) refers to the ajax object not form
                dataType: 'json', // let's set the expected response format
                success: function(data) {
                    console.log(data);

                    var html = '';

                    var numberinc = data.from
                    var base_url = '{{ config("isec.base_url") }}';
                    $.each(data.data, function(index, item) {
                        html += `
                    <tr>
                        <td class="text-center">${numberinc}</td>
                        <td style="font-size:medium;">
                            <a href="${base_url}/data/detail/${item.id_data_file_encrypt}">
                            ${item.keterangan}
                            </a>    
                        </td>
                        <td class="text-center">
                            <span class="text-muted" style="font-size:small !important">${item.instansi ? item.instansi.name : '-'}</span> <br>
                            <span class="badge badge-primary" style="font-size:small !important">${item.kategori.name}</span>
                        </td>
                        <td class="text-center" style="color:grey; font-size:small;">${item.klasifikasi ? item.klasifikasi.name : '-'} <hr> ${item.subklasifikasi ? item.subklasifikasi.name : '-'}</td>
                        <td class="text-center" style="color:grey; font-size:small;">${item.tahun}/${item.tempat == null ? '-' : item.tempat}</td>
                        <td class="text-center" style="color:grey; font-size:small;">${item.penanggung_jawab == null ? '-' : item.penanggung_jawab}</td>
                        <td class="text-center" style="color:grey; font-size:small;">
                            ${item.hits} kunjungan 
                            <hr>
                            ${item.download} unduhan
                            </td>
                    </tr>
                `;
                        numberinc++;
                    });

                    if (data.data.length == 0) {
                        html += `
                    <tr>
                        <td colspan="7" class="text-center">-- Data / informasi tidak ditemukan --</td>
                    </tr>
                `;
                    }

                    // setTimeout(function() {

                    var box = $(".container-data");
                    box.empty();
                    // box.append(html);
                    $(html).appendTo('.container-data').fadeIn('slow');

                    $('#defTbl').unblock();

                    var boxfooter = $(".table-footer")
                    boxfooter.empty();

                    var footer =
                        `<ul class="mt-3 pagination justify-content-center pagination-primary">`
                    $.each(data.links, function(index, item) {

                        if (index == 0) {
                            footer +=
                                `<li class="page-item ${data.current_page == 1 ? 'disabled' : ''} "><button class="page-link" data-selfuri="${item.url}" href="javascript:void(0)" data-bs-original-title="" title="">Previous</button></li>`;
                        }
                        if (index == (data.last_page + 1)) {
                            footer +=
                                `<li class="page-item ${data.current_page == data.last_page ? 'disabled' : ''} "><button class="page-link" data-selfuri="${item.url}" href="javascript:void(0)" data-bs-original-title="" title="">Next</button></li>`;
                        }
                        if (index > (data.current_page - 3) && index < (data
                                .current_page + 3) && index != 0 && index != (data
                                .last_page + 1)) {
                            footer +=
                                `<li class="page-item ${item.active ? 'active' : ''} "><button class="page-link" data-selfuri="${item.url}" href="javascript:void(0)" data-bs-original-title="" title="">${item.label}</button></li>`;
                        }
                    });
                    footer += `</ul>`;
                    boxfooter.append(footer);

                    $('.page-link').click(function() {
                        console.log('clicked');
                        url = $(this).data('selfuri');
                        loadData();
                    });
                    // }, 1000);




                }
            })

        }

    // });
</script>

@endsection