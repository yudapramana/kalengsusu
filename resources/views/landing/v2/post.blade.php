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
    <link rel="canonical" href="{{ URL::current() }}" />

    {{-- Open Graph / Facebook --}}
    <meta property="og:site_name" content="Web Kemenag Kanwil Prov Sumbar">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->meta_desc }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ URL::current() }}">
    {{-- gunakan cover_url accessor; fallback jika null --}}
    @php
        $ogImage = $post->cover_url ?? 'https://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg';
    @endphp
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:secure_url" content="{{ $ogImage }}">
    {{-- optional: width/height jika diketahui --}}
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="id_ID">
    @if ($post->created_at)
        <meta property="article:published_time" content="{{ $post->created_at->toIso8601String() }}">
    @endif
    @if ($post->updated_at)
        <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
    @endif
    <meta property="article:author" content="{{ $post->user->name ?? '' }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->meta_desc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    {{-- optionally add twitter:site or twitter:creator --}}
    {{-- <meta name="twitter:site" content="@your_twitter_handle"> --}}
    {{-- <meta name="twitter:creator" content="@author_handle"> --}}

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
                        @if ($post->cover)
                            <div class="blog_img">
                                <a href="#">
                                    <img src="{{ $post->cover_url }}" alt="blog_img1">
                                </a>
                            </div>
                        @endif

                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h2>{{ $post->title }}</h2>
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ion-calendar"></i> {{ $post->created_at->format('d F Y') }}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i> {{ $post->reads }} Reads</a></li>
                                    <li><a href="{{ config('isec.base_url') }}/blog?author={{ $post->user->name }}"><i class="ion-android-contacts"></i> {{ $post->user->name }}</a>
                                    </li>
                                </ul>


                                <div class="entry-content">
                                    {!! $post->desc !!}
                                </div>

                                <div>
                                    <hr class="mt-10 mb-10">
                                    <div class="container row justify-content-between ml-0 p-0">
                                        <div class="col-sm-6 p-0">
                                            <span>Editor:</span>
                                            <span class="font-weight-900" style="color:black"><a href="/author/moh-khoeron">{{ $post->editor ? $post->editor : '-' }}</a></span>
                                        </div>
                                        <div class="col-sm-6 p-0">
                                            <span>Fotografer:</span>
                                            <span class="font-weight-900" style="color:black"><a href="/author/istimewa">{{ $post->photographer ? $post->photographer : '-' }}</a></span>
                                        </div>
                                    </div>
                                    <hr class="mt-10 mb-10">
                                </div>

                                <div class="py-4 blog_post_footer">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-md-8 mb-3 mb-md-0">
                                            <div class="tags">
                                                @foreach ($post->tags as $key => $tag)
                                                    <a href="{{ config('isec.base_url') }}/blog?tag={{ $tag->slug }}">{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="share-buttons">
                                                @php
                                                    $shareUrl = urlencode(URL::current());
                                                    $shareTitle = urlencode($post->title);
                                                    $shareDesc = urlencode($post->meta_desc);
                                                    $shareImage = urlencode($ogImage);
                                                @endphp

                                                <ul class="list_none social_icons border_social rounded_social">
                                                    {{-- Facebook --}}
                                                    <li>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" class="share-btn" data-popup="true" data-href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" title="Share to Facebook">
                                                            <i class="ion-social-facebook"></i>
                                                        </a>
                                                    </li>

                                                    {{-- Twitter --}}
                                                    <li>
                                                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" class="share-btn" data-popup="true" data-href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" title="Share to Twitter">
                                                            <i class="ion-social-twitter"></i>
                                                        </a>
                                                    </li>

                                                    {{-- LinkedIn --}}
                                                    <li>
                                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" class="share-btn" data-popup="true" data-href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" title="Share to LinkedIn">
                                                            <i class="ion-social-linkedin-outline"></i>
                                                        </a>
                                                    </li>

                                                    {{-- WhatsApp (mobile & web) --}}
                                                    <li>
                                                        <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" class="share-btn" target="_blank" title="Share to WhatsApp">
                                                            <i class="ion-social-whatsapp"></i>
                                                        </a>
                                                    </li>

                                                    {{-- Telegram --}}
                                                    <li>
                                                        <a href="https://t.me/share/url?url={{ $shareUrl }}&text={{ $shareTitle }}" class="share-btn" data-popup="true" data-href="https://t.me/share/url?url={{ $shareUrl }}&text={{ $shareTitle }}" title="Share to Telegram">
                                                            <i class="ion-paper-airplane"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
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

                                @foreach ($recent_posts as $key => $post)
                                    <li>
                                        <div class="post_footer">
                                            <div class="post_img">
                                                <a href="{{ config('isec.base_url') }}/post/{{ $post->slug }}">
                                                    @if ($post->cover)
                                                        <img src="{{ $post->cover }}" alt="letest_post1" width="60">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="post_content">
                                                <h6><a href="{{ config('isec.base_url') }}/post/{{ $post->slug }}">{{ \Illuminate\Support\Str::limit($post->title, 20, $end = '...') }}</a>
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
                                    <li><a href="{{ config('isec.base_url') }}/blog?category={{ $category->slug }}"><span class="categories_name">{{ $category->title }}</span><span class="categories_num">({{ $category->posts_count }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <h5 class="widget_title">tags</h5>
                            <div class="tags">
                                @foreach ($tags as $tag)
                                    <a href="{{ config('isec.base_url') }}/blog?tag={{ $tag->slug }}"">{{ $tag->name }}</a>
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
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": {!! json_encode($post->title) !!},
      "description": {!! json_encode($post->meta_desc) !!},
      "image": {!! json_encode($ogImage) !!},
      "author": {
        "@type": "Person",
        "name": {!! json_encode($post->user->name ?? '') !!}
      },
      "publisher": {
        "@type": "Organization",
        "name": "Web Kemenag Kanwil Prov Sumbar"
      },
      "datePublished": {!! json_encode(optional($post->created_at)->toIso8601String()) !!},
      "dateModified": {!! json_encode(optional($post->updated_at)->toIso8601String()) !!}
    }
    </script>
    <script>
        document.addEventListener('click', function(e) {
            var el = e.target.closest('a.share-btn');
            if (!el) return;
            var href = el.getAttribute('data-href') || el.href;
            // if target="_blank" (like WhatsApp), let it open normally
            if (el.target === '_blank' && href.includes('api.whatsapp.com')) return;

            e.preventDefault();
            var w = 600,
                h = 500;
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);
            window.open(href, 'ShareWindow', 'toolbar=0,status=0,width=' + w + ',height=' + h + ',top=' + top + ',left=' + left);
        });
    </script>
@endsection
