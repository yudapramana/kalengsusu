@extends('layouts.landing.v2.master')
@section('title', 'PPID Blog List')

@section('_styles')

{{-- Primary Meta Tags --}}
<meta name="title" content="{{$title}}">
<meta name="description" content="{{$title}}" />
<meta name="keywords" content="PPID, PPID Kementerian Agama, Web Kemenag Kanwil Prov Sumbar, Komisi Informasi" />
<meta name="author" content="PPID Kantor Wilayah Kementerian Agama Prov. Sumatera Barat" />
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
            <div class="col-sm-12 pt-5 pb-3 wow fadeInLeft animated">
                <h4 class="greenext"> Daftar Berita</h4>
            </div>
        </div>
    </div>

</section>


<section class="p-0 m-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">

                <div class="row">

                    @forelse($activities as $key => $act)

                    <div class="col-md-12 mb-md-4 mb-2 pb-2">
                        <div class="blog_post">
                            @if($act->cover_image_url)
                            <div class="blog_img">
                                <a href="#">
                                    <img src="{{ $act->cover_image_url }}" alt="blog_img1">
                                </a>
                            </div>
                            @endif
                            <div class="blog_content bg-white">
                                <div class="blog_text">
                                    <h6 class="blog_title"><a href="#">{{$act->name}}</a>
                                    </h6>
                                    <ul class="list_none blog_meta">
                                        <li><a href="#"><i class="ion-calendar"></i> {{ $act->created_at->format('d F
                                                Y') }}</a></li>
                                    </ul>
                                    <p> {{ $act->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    @empty
                    <p>No Posts Shown</p>
                    @endforelse


                    {{-- <div class="col-md-12 mb-md-4 mb-2 pb-2">
                        <div class="blog_post">
                            <div class="blog_img">
                                <a href="#">
                                    <img src="images/blog_img2.jpg" alt="blog_img2">
                                </a>
                            </div>
                            <div class="blog_content bg-white">
                                <div class="blog_text">
                                    <h6 class="blog_title"><a href="#">A cheap and flexible solution for those who want
                                            a starter package </a></h6>
                                    <ul class="list_none blog_meta">
                                        <li><a href="#"><i class="ion-calendar"></i> April 14, 2018</a></li>
                                        <li><a href="#"><i class="ion-chatboxes"></i> 2 Comment</a></li>
                                    </ul>
                                    <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary,
                                        making this the first true generator on the Internet.</p>
                                    <a href="#" class="text-capitalize">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <div class="row">
                    <div class="col-12 mt-4">
                        <ul class="pagination justify-content-center">
                            {{ $activities->links('pagination::bootstrap-4') }}
                        </ul>
                    </div>
                </div>





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

@endsection