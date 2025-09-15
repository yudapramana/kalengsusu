@extends('layouts.landing.v2.master')
@section('title', 'Web - ' . $post->title)

@section('_styles')

<!-- Primary Meta Tags -->
<title>{{ $post->title }}</title>
<meta name="title" content="{{ $post->title }}">
<meta name="description" content="{{ $post->meta_desc }}">
<meta name="keywords" content="{{ $post->keywords }}">
<meta name="author" content="Web Kemenag Kanwil Prov Sumbar" />
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<meta name="revisit-after" content="1 Days" />

<!-- Open Graph / Facebook -->
<meta property="og:site_name" content="Web Kemenag Kanwil Prov Sumbar">
<meta property="og:title" content="Web Kemenag Kanwil Prov Sumbar - {{ $post->title }} ">
<meta property="og:locale" content="id_ID">

<meta property="og:type" content=article />
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:description" content="{{ $post->meta_desc }}">
<meta property="og:image" content="{{ $post->cover }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ URL::current() }}">
<meta property="twitter:title" content="{{ $post->title }}">
<meta property="twitter:description" content="{{ $post->meta_desc }}">
<meta property="twitter:image" content="{{ $post->cover }}">
<meta name="twitter:site" content="{{ URL::current() }}" />

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
<section class="mt-2 pt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="single_post">
                    @if($post->cover)
                    <div class="blog_img">
                        <a href="#">
                            <img src="{{$post->cover}}" alt="blog_img1">
                        </a>
                    </div>
                    @endif

                    <div class="blog_content bg-white">
                        <div class="blog_text">
                            <h2>{{$post->title}}</h2>
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="ion-calendar"></i> {{ $post->created_at->format('d F Y')
                                        }}</a></li>
                                <li><a href="#"><i class="ion-eye"></i> {{$post->reads}} Reads</a></li>
                                <li><a href="{{config('isec.base_url')}}/blog?author={{$post->user->name}}"><i
                                            class="ion-android-contacts"></i> {{ $post->user->name }}</a>
                                </li>
                            </ul>


                            <div class="entry-content">
                                {!!$post->desc!!}
                            </div>

                            <div>
                                <hr class="mt-10 mb-10">
                                <div class="container row justify-content-between ml-0 p-0">
                                    <div class="col-sm-6 p-0">
                                        <span>Editor:</span>
                                        <span class="font-weight-900" style="color:black"><a
                                                href="/author/moh-khoeron">{{$post->editor ? $post->editor :
                                                '-'}}</a></span>
                                    </div>
                                    <div class="col-sm-6 p-0">
                                        <span>Fotografer:</span>
                                        <span class="font-weight-900" style="color:black"><a href="/author/istimewa">{{
                                                $post->photographer ? $post->photographer : '-' }}</a></span>
                                    </div>
                                </div>
                                <hr class="mt-10 mb-10">
                            </div>

                            <div class="py-4 blog_post_footer">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <div class="tags">
                                            @foreach($post->tags as $key => $tag)
                                            <a
                                                href="{{config('isec.base_url')}}/blog?tag={{$tag->slug}}">{{$tag->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list_none social_icons border_social rounded_social">
                                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                            <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<!-- END SECTION BLOG -->


@endsection


@section('_scripts')
{{-- No Data --}}
@endsection