@extends('layouts.landing.v2.master')

@section('title', 'Web - Galeri dan Foto')

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

<!-- START SECTION CONTACT -->

<div class="container">

    @if($type == 'foto')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="heading_s3 text-center animation animated fadeInUp" data-animation="fadeInUp"
                        data-animation-delay="0.2s" style="animation-delay: 0.2s; opacity: 1;">
                        <h2 class="greenext">Galeri Foto</h2>
                    </div>
                    {{-- <p class="text-center animation animated fadeInUp" data-animation="fadeInUp"
                        data-animation-delay="0.3s" style="animation-delay: 0.3s; opacity: 1;">Lorem ipsum dolor sit
                        amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius
                        nunc.</p> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cleafix small_divider"></div>
                </div>
            </div>

            <div class="row mb-3 mb-sm-5">
                <div class="col-md-12 text-center">
                    <ul class="list_none portfolio_filter filter_tab6 animation animated fadeInUp"
                        data-animation="fadeInUp" data-animation-delay="0.4s"
                        style="animation-delay: 0.4s; opacity: 1;">
                        <li><a href="#" class="current" data-filter="*">all</a></li>

                        @foreach($filterTags as $key => $tag)
                        <li><a href="#" data-filter="{{ '.' . $tag}}">{{$tag}}</a></li>
                        @endforeach


                        {{-- <li><a href="#" data-filter=".brands">Brands</a></li>
                        <li><a href="#" data-filter=".design">Design</a></li>
                        <li><a href="#" data-filter=".web">Web</a></li>
                        <li><a href="#" data-filter=".adv">Advertising</a></li> --}}
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="portfolio_container gutter_small work_col3 portfolio_gallery portfolio_style3 animation animated fadeInUp"
                        data-animation="fadeInUp" data-animation-delay="0.4s"
                        style="animation-delay: 0.4s; opacity: 1; position: relative; height: 1079.86px;">
                        <li class="grid-sizer"></li>


                        @foreach($galleries as $key => $gallery)

                        {{-- <div class="col-lg-4 col-md-6 portfolio-item {{$gallery->filter_tag}}">
                            <div class="portfolio-wrap">
                                <img src="{{ $gallery->thumbnail_image }}" class="img-fluid" alt="{{ $gallery->alt }}">
                                <div class="portfolio-info">
                                    <h4>{{ $gallery->title }}</h4>
                                    <p>{{ $gallery->filter_tag }}</p>
                                    <div class="portfolio-links">
                                        <a href="{{ $gallery->image_url }}" data-gallery="portfolioGallery"
                                            class="portfolio-lightbox" title="{{ $gallery->title }}"><i
                                                class="bx bx-plus"></i></a>
                                        <a href="#" class="portfolio-details-lightbox" data-glightbox="type: external"
                                            title="Portfolio Details"><i class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- START PORTFOLIO ITEM -->
                        <li class="portfolio-item {{$gallery->filter_tag}}">
                            <div class="portfolio_item">
                                <a href="#" class="image_link">
                                    <img src="{{ $gallery->thumbnail_image }}" alt="{{ $gallery->alt }}">
                                </a>
                                <div class="portfolio_content">
                                    <div class="link_container">
                                        <a href="{{ $gallery->image_url }}" class="image_popup"><i
                                                class="ion-image"></i></a>
                                        <a href="#"><i class="ion-plus"></i></a>
                                    </div>
                                    <h5><a href="#">{{ $gallery->title }}</a></h5>
                                    <p>{{ $gallery->description }}</p>
                                </div>
                            </div>
                        </li>
                        <!-- END PORTFOLIO ITEM -->


                        @endforeach




                    </ul>
                </div>
            </div>

        </div>
    </section>
    @endif


    @if($type == 'video')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="heading_s3 text-center animation animated fadeInUp" data-animation="fadeInUp"
                        data-animation-delay="0.2s" style="animation-delay: 0.2s; opacity: 1;">
                        <h2 class="greenext">Galeri Video</h2>
                    </div>
                    {{-- <p class="text-center animation animated fadeInUp" data-animation="fadeInUp"
                        data-animation-delay="0.3s" style="animation-delay: 0.3s; opacity: 1;">Lorem ipsum dolor sit
                        amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius
                        nunc.</p> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cleafix small_divider"></div>
                </div>
            </div>

            <div class="row mb-3 mb-sm-5">
                <div class="col-md-12 text-center">
                    <ul class="list_none portfolio_filter filter_tab6 animation animated fadeInUp"
                        data-animation="fadeInUp" data-animation-delay="0.4s"
                        style="animation-delay: 0.4s; opacity: 1;">
                        <li><a href="#" class="current" data-filter="*">all</a></li>

                        @foreach($filterTags as $key => $tag)
                        <li><a href="#" data-filter="{{ '.' . $tag}}">{{$tag}}</a></li>
                        @endforeach


                        {{-- <li><a href="#" data-filter=".brands">Brands</a></li>
                        <li><a href="#" data-filter=".design">Design</a></li>
                        <li><a href="#" data-filter=".web">Web</a></li>
                        <li><a href="#" data-filter=".adv">Advertising</a></li> --}}
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="portfolio_container gutter_small work_col3 portfolio_gallery portfolio_style3 animation animated fadeInUp"
                        data-animation="fadeInUp" data-animation-delay="0.4s"
                        style="animation-delay: 0.4s; opacity: 1; position: relative; height: 1079.86px;">
                        <li class="grid-sizer"></li>


                        @foreach($galleries as $key => $gallery)

                        {{-- <div class="col-lg-4 col-md-6 portfolio-item {{$gallery->filter_tag}}">
                            <div class="portfolio-wrap">
                                <img src="{{ $gallery->thumbnail_image }}" class="img-fluid" alt="{{ $gallery->alt }}">
                                <div class="portfolio-info">
                                    <h4>{{ $gallery->title }}</h4>
                                    <p>{{ $gallery->filter_tag }}</p>
                                    <div class="portfolio-links">
                                        <a href="{{ $gallery->image_url }}" data-gallery="portfolioGallery"
                                            class="portfolio-lightbox" title="{{ $gallery->title }}"><i
                                                class="bx bx-plus"></i></a>
                                        <a href="#" class="portfolio-details-lightbox" data-glightbox="type: external"
                                            title="Portfolio Details"><i class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- START PORTFOLIO ITEM -->
                        <li class="portfolio-item brands {{$gallery->filter_tag}}">
                            <div class="portfolio_item">
                                <a href="#" class="image_link">
                                    <img src="{{ $gallery->thumbnail_image }}" alt="image">
                                </a>
                                <div class="portfolio_content">
                                    <div class="link_container">
                                        <a href="{{ $gallery->url }}" class="video_popup"><i
                                                class="ion-ios-play"></i></a>
                                        <a href="#"><i class="ion-plus"></i></a>
                                    </div>
                                    <h5><a href="#">{{ $gallery->title }}</a></h5>
                                    <p>{{ $gallery->description }}</p>
                                </div>
                            </div>
                        </li>
                        <!-- END PORTFOLIO ITEM -->

                        @endforeach




                    </ul>
                </div>
            </div>

        </div>
    </section>
    @endif


    @if($type == 'ebook')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="heading_s3 text-center animation animated fadeInUp" data-animation="fadeInUp"
                        data-animation-delay="0.2s" style="animation-delay: 0.2s; opacity: 1;">
                        <h2 class="greenext">E-Book</h2>
                        <h5 class="greenext">Karya Buku Digital</h5>
                    </div>
                    {{-- <p class="text-center animation animated fadeInUp" data-animation="fadeInUp"
                        data-animation-delay="0.3s" style="animation-delay: 0.3s; opacity: 1;">Lorem ipsum dolor sit
                        amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius
                        nunc.</p> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cleafix small_divider"></div>
                </div>
            </div>

            <div class="row mb-3 mb-sm-5">
                <div class="col-md-12 text-center">
                    <ul class="list_none portfolio_filter filter_tab6 animation animated fadeInUp"
                        data-animation="fadeInUp" data-animation-delay="0.4s"
                        style="animation-delay: 0.4s; opacity: 1;">
                        <li><a href="#" class="current" data-filter="*">all</a></li>

                        @foreach($filterTags as $key => $tag)
                        <li><a href="#" data-filter="{{ '.' . $tag}}">{{$tag}}</a></li>
                        @endforeach


                        {{-- <li><a href="#" data-filter=".brands">Brands</a></li>
                        <li><a href="#" data-filter=".design">Design</a></li>
                        <li><a href="#" data-filter=".web">Web</a></li>
                        <li><a href="#" data-filter=".adv">Advertising</a></li> --}}
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="portfolio_container gutter_small work_col3 portfolio_gallery portfolio_style3 animation animated fadeInUp"
                        data-animation="fadeInUp" data-animation-delay="0.4s"
                        style="animation-delay: 0.4s; opacity: 1; position: relative; height: 1079.86px;">
                        <li class="grid-sizer"></li>


                        @foreach($galleries as $key => $gallery)

                        {{-- <div class="col-lg-4 col-md-6 portfolio-item {{$gallery->filter_tag}}">
                            <div class="portfolio-wrap">
                                <img src="{{ $gallery->thumbnail_image }}" class="img-fluid" alt="{{ $gallery->alt }}">
                                <div class="portfolio-info">
                                    <h4>{{ $gallery->title }}</h4>
                                    <p>{{ $gallery->filter_tag }}</p>
                                    <div class="portfolio-links">
                                        <a href="{{ $gallery->image_url }}" data-gallery="portfolioGallery"
                                            class="portfolio-lightbox" title="{{ $gallery->title }}"><i
                                                class="bx bx-plus"></i></a>
                                        <a href="#" class="portfolio-details-lightbox" data-glightbox="type: external"
                                            title="Portfolio Details"><i class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- START PORTFOLIO ITEM -->
                        <li class="portfolio-item {{$gallery->filter_tag}}">
                            <div class="portfolio_item">
                                <a href="#" class="image_link">
                                    <img src="{{ $gallery->thumbnail_image }}" alt="{{ $gallery->alt }}">
                                </a>
                                <div class="portfolio_content">
                                    <div class="link_container">
                                        <a href="{{ $gallery->image_url }}" class="image_popup"><i
                                                class="ion-image"></i></a>
                                        <a href="{{ $gallery->url }}" target="_blank"><i
                                                class="ion-android-download"></i></a>
                                    </div>
                                    <h5><a href="#">{{ $gallery->title }}</a></h5>
                                    <p>{{ $gallery->description }}</p>
                                </div>
                            </div>
                        </li>
                        <!-- END PORTFOLIO ITEM -->


                        @endforeach




                    </ul>
                </div>
            </div>

        </div>
    </section>
    @endif

</div>
<!-- END SECTION CONTACT -->


@endsection


@section('_scripts')
{{-- No Data --}}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    // Cloudinary Widget
        var myWidget = cloudinary.createUploadWidget({
            cloudName: 'kominfo-sb',
            uploadPreset: 'zwco5rur',
            theme: 'minimal',
            multiple: false,
            max_file_size: 10048576,
            background: "white",
            height: 600,
            width: 400,
            crop: "pad"

        }, (error, result) => {
            if (!error && result && result.event === "success") {
                console.log('Done! Here is the image info: ', result.info);
                var secure_url = result.info.secure_url;
                console.log('secure_url');
                console.log(secure_url);
                $('input[name=identity_url]').val(secure_url);
                $('#foto-produk-box').css("display", "block");
                $('#upload_widget_opener').css("display", "none");
                $('#tu-upload-box').hide();
                $('#foto-produk-src').attr("src", secure_url);
                // $('#foto-produk-url').attr("href", secure_url);
                $("#defModal").css('overflow-y', 'auto');
            }
        });

        // document.getElementById("upload_widget_opener").addEventListener("click", function() {
        //     myWidget.open();
        // }, false);

        $('#reload').click(function() {
            reloadCaptcha();
        });

        function reloadCaptcha() {
            $.ajax({
                type: 'GET',
                url: "{{ route('reload.captcha') }}",
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        }

        $('.video_popup').click(function(e) {
            var not_secure_url = $(this).attr('href');

            not_secure_url = not_secure_url.replace("watch?v=", "embed/");
            not_secure_url = not_secure_url + '?autoplay=1'
            
            setTimeout(function() {
                loadIframe('mfp-iframe', not_secure_url)
            }, 2000);

        });

        function loadIframe(iframeName, url) {
            var $iframe = $('.' + iframeName);
            if ($iframe.length) {
                $iframe.attr('src',url);
                return false;
            }
            return true;
        }

        $('#savePermohonanBtn').click(function(e) {

            var formData = $('#permohonanForm').serializeArray();
            console.log(formData);

            if ($("#permohonanForm").valid()) {
                $('#savePermohonanBtn').attr("disabled", "disabled");
                e.preventDefault();

                var url = $('#permohonanForm').attr('action');

                var formdata = $("#permohonanForm").serialize(); // here $(this) refere to the form its submitting
                console.log(formdata);

                Swal.fire({
                    title: "Checking...",
                    text: "Please wait",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 1000,
                });

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData, // here $(this) refers to the ajax object not form
                    dataType: 'json', // let's set the expected response format
                    success: function(data) {
                        console.log(data);

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Permohonan berhasil disimpan!.',
                                confirmButtonText: "OK",
                                allowOutsideClick: false
                                    // , timer: 1000
                                    ,
                            }).then(function() {
                                window.location.href = "/";
                            });
                        } else {
                            $('#savePermohonanBtn').attr("disabled", false);
                            Swal.fire({
                                title: "Permohonan Gagal!",
                                text: data.message,
                                type: "error",
                                confirmButtonText: "OK",
                                allowOutsideClick: false,
                            });
                            reloadCaptcha();
                        }

                        // Swal.fire({
                        //     icon: 'success'
                        //     , title: 'Permohonan berhasil disimpan!.'
                        //     , html: 'Page will be redirected in <b></b> milliseconds.'
                        //     , timer: 2000
                        //     , showCancelButton: false
                        //     , showConfirmButton: false
                        //     , timerProgressBar: true
                        //     , allowOutsideClick: false
                        //     , willOpen: () => {
                        //         Swal.showLoading()
                        //         timerInterval = setInterval(() => {
                        //             const content = Swal.getContent()
                        //             if (content) {
                        //                 const b = content.querySelector('b')
                        //                 if (b) {
                        //                     b.textContent = Swal.getTimerLeft()
                        //                 }
                        //             }
                        //         }, 100)
                        //     }
                        //     , willClose: () => {
                        //         clearInterval(timerInterval)
                        //     }
                        // }).then((result) => {
                        //     /* Read more about handling dismissals below */
                        //     if (result.dismiss === Swal.DismissReason.timer) {
                        //         // location.reload('/');
                        //         window.location.href = "/";
                        //     }
                        // })

                    },
                    error: function(err) {



                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            // you can loop through the errors object and show it to the user
                            console.warn(err.responseJSON.errors);
                            // display errors on each form field
                            $('.ajax-invalid').remove();
                            $.each(err.responseJSON.errors, function(i, error) {
                                var el = $(document).find('[name="' + i + '"]');
                                el.addClass('is-invalid');
                                el.after($('<span class="error invalid-feedback" >' + error[0] + '</span>'));
                            });

                            Swal.fire({
                                title: "Pengecekan Selesai!",
                                showConfirmButton: false,
                                timer: 700
                            });
                            $('#savePermohonanBtn').attr("disabled", false);
                            reloadCaptcha();
                        } else if (err.status == 403) {
                            Swal.fire(
                                'Unauthorized!', 'You are unauthorized to do the action', 'warning'
                            );

                        }

                    }
                });


            } else {
                Swal.fire(
                    'Error!', 'Perhatian! Perbaiki isian Formulir', 'error'
                );
            }

        });

        $("#permohonanForm").validate({
            ignore: [],
            rules: {
                jenis_pemohon: {
                    required: true
                },
                jenis_identitas: {
                    required: true
                },
                nomor_identitas: {
                    required: true
                },
                nama_pemohon: {
                    required: true
                },
                email: {
                    required: true
                },
                no_telp: {
                    required: true
                },
                alamat: {
                    required: true
                },
                pekerjaan: {
                    required: true
                },
                identity_url: {
                    required: true
                },
                rincian_informasi: {
                    required: true
                },
                tujuan_penggunaan_informasi: {
                    required: true
                },
                cara_pemakaian_informasi: {
                    required: true
                },
                cara_memperoleh_informasi: {
                    required: true
                },
                bentuk_informasi: {
                    required: true
                },
                cara_mendapatkan_salinan: {
                    required: true
                },
                captcha: {
                    required: true
                },

            },
            messages: {

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
</script>


@endsection