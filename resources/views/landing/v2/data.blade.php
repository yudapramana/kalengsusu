@extends('layouts.landing.v2.master')
@section('title', 'Web - ' . $keterangan)


@section('_styles')

{{-- Primary Meta Tags --}}
<meta name="title" content="{{$keterangan}}">
<meta name="description" content="{{$keterangan}}" />
<meta name="keywords" content="PPID Kemenag, PPID, Komisi Informasi" />
<meta name="author" content="Web Kemenag Kanwil Prov Sumbar" />
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<meta name="revisit-after" content="1 Days" />

<!-- Open Graph / Facebook -->
<meta property="og:site_name" content="{{$keterangan}}">
<meta property="og:title" content="{{$keterangan}}">
<meta property="og:locale" content="id_ID">
<meta property="og:description" content="Web - {{$keterangan}}">
<meta property="og:image" content="{{ asset('sailor/img/logo.png') }}" />

<meta property="og:type" content=website />
<meta property="og:url" content="{{ URL::current() }}" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="{{$keterangan}}" />
<meta name="twitter:title" content="{{$keterangan}}" />
<meta name="twitter:description" content="Web - {{$keterangan}}">
<meta name="twitter:image" content="{{ asset('sailor/img/logo.png') }}" />
<meta property="twitter:url" content="{{ URL::current() }}">

<link rel="canonical" href="{{ URL::current() }}" />
<link rel="alternate" hreflang="en-US" href="{{ URL::current() }}" />
<link rel="shortcut icon" type="image/png" href="{{ URL::current() }}" />
<style>
    .preserveLines {
        white-space: pre-wrap;
    }
</style>

@endsection

@section('content')

<hr class="pt-0 mt-0">

<!-- START SECTION BLOG -->
<section class="m-0 p-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-sm-12">
                            <div class="heading_s3 mb-0">
                                <span class="sub_title">Informasi Berkala</span>
                                <h3>{{ $dataFile->keterangan }}</h3>
                            </div>
                            <p>{{ $dataFile->keterangan }}</p>

                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="ion-calendar"></i> {{ $dataFile->created_at->format('d F Y')
                                        }}</a></li>
                                <li><a href="#"><i class="ion-eye"></i> {{$dataFile->hits}} Hits</a></li>
                                <li><a href="#"><i class="ion-android-contacts"></i> {{ $dataFile->created_by }}</a>
                                </li>
                            </ul>

                            @if($dataFile->akses == 'public')
                            <a href="{{config('isec.base_url')}}/data/download/{{ $dataFile->id_data_file_encrypt }}"
                                class="btn btn-xs btn-primary">
                                Download
                            </a>
                            @elseif($dataFile->akses == 'private')
                            Data Dikecualikan / Rahasia
                            @else
                            Silahkan Login untuk melihat Data
                            @endif

                        </div>
                    </div>
                </div>

                <section class="small_pt">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div id="accordion" class="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h6 class="mb-0"> <a data-toggle="collapse" href="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">Instansi</a> </h6>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                {{ $dataFile->instansi ? $dataFile->instansi->name : 'Tidak ada
                                                Instansi'}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h6 class="mb-0"> <a class="collapsed" data-toggle="collapse"
                                                    href="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo">Klasifikasi</a> </h6>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                {{ $dataFile->klasifikasi ? $dataFile->klasifikasi->name : 'Tidak ada
                                                Klasifikasi' }} - {{
                                                $dataFile->subklasifikasi ? $dataFile->subklasifikasi->name : 'Tidak ada
                                                Subklasifikasi'
                                                }}
                                                <hr>
                                                <button class="btn btn-xs btn-primary">{{
                                                    $dataFile->kategori->name
                                                    }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h6 class="mb-0"> <a class="collapsed" data-toggle="collapse"
                                                    href="#collapseThree" aria-expanded="false"
                                                    aria-controls="collapseThree">Information</a> </h6>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="no-border">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-right pr-3"><strong>Nama
                                                                    File</strong></td>
                                                            <td>{{ $dataFile->nama_file }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right pr-3"><strong>File
                                                                    Ekstensi</strong></td>
                                                            <td>{{ $dataFile->ext }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right pr-3">
                                                                <strong>Keterangan</strong>
                                                            </td>
                                                            <td>{{ $dataFile->keterangan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right pr-3"><strong>Tanggal
                                                                    Upload</strong></td>
                                                            <td>{{ $dataFile->created_at }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right pr-3"><strong>Diupload
                                                                    Oleh</strong></td>
                                                            <td>{{ $dataFile->created_by }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right pr-3">
                                                                <strong>Dikunjungi</strong>
                                                            </td>
                                                            <td>{{ $dataFile->hits }} kali</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right pr-3">
                                                                <strong>Download</strong>
                                                            </td>
                                                            <td>{{ $dataFile->download }} kali Unduhan</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h6 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" href="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">Download File</a>


                                            </h6>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="headingThree"
                                            data-parent="#accordion">
                                            <div class="card-body">

                                                @if($dataFile->akses == 'public')
                                                <a href="{{config('isec.base_url')}}/data/download/{{ $dataFile->id_data_file_encrypt }}"
                                                    class="btn btn-xs btn-primary">
                                                    Download
                                                </a>
                                                @elseif($dataFile->akses == 'private')
                                                Data Dikecualikan / Rahasia
                                                @else
                                                Silahkan Login untuk melihat Data
                                                @endif



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 mt-lg-0 mt-4 pt-3 pt-lg-0">
                <div class="sidebar">

                    <div class="widget">
                        <h5 class="widget_title">Recent Posts</h5>
                        <ul class="recent_post border_bottom_dash list_none">

                            @foreach($recent_posts as $key => $post)
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="{{config('isec.base_url')}}/post/{{$post->slug}}">
                                            @if($post->cover)
                                            <img src="{{$post->cover}}" alt="letest_post1" width="60">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="{{config('isec.base_url')}}/post/{{$post->slug}}">{{\Illuminate\Support\Str::limit($post->title,
                                                20, $end='...')}}</a>
                                        </h6>
                                        <p class="small m-0">{{ $post->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">Categories</h5>
                        <ul class="list_none widget_categories border_bottom_dash">
                            @foreach ($categories as $category)

                            <li><a href="{{config('isec.base_url')}}/blog?category={{$category->slug}}"><span
                                        class="categories_name">{{$category->title}}</span><span
                                        class="categories_num">({{$category->posts_count}})</span></a>
                            </li>

                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">tags</h5>
                        <div class="tags">
                            @foreach ($tags as $tag)
                            <a href="{{config('isec.base_url')}}/blog?tag={{$tag->slug}}"">{{$tag->name}}</a>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<!-- END SECTION BLOG -->


@endsection


@section('_scripts')
{{-- No Data --}}
@endsection