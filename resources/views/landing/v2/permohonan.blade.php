@extends('layouts.landing.v2.master')

@section('title', 'Web - Buat Permohonan')

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

    <section class="py-0 my-0">

        <div class="row py-0 my-0">
            <div class="col-sm-12 py-0 my-0 wow fadeInLeft animated">

                <h3 class="greenext">Permohonan Informasi</h3>


            </div>


        </div>
    </section>

    <section class="py-0 my-0">

        {{-- <form action="{{ route('permohonan.store') }}"> --}}
            <form class="needs-validation" method="post" id="permohonanForm" action={{ route('permohonan.store') }}
                role="form">
                {{ csrf_field() }}
                <hr class="styledhr">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <legend class="font-weight-bold">Identitas Pemohon</legend>

                        <div class="form-group">
                            <label for="jenis_pemohon">Jenis Pemohon</label>
                            <select class="form-control" id="jenis_pemohon" name="jenis_pemohon">
                                <option value="">Pilih</option>
                                <option value="pribadi">Pribadi</option>
                                <option value="kelompok">Kelompok</option>
                                <option value="badan hukum">Badan Hukum</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jenis_identitas">Jenis Identitas</label>
                            <select class="form-control" id="jenis_identitas" name="jenis_identitas">
                                <option value="">Pilih</option>
                                <option value="ktp">KTP</option>
                                <option value="surat kuasa">Surat Kuasa</option>
                                <option value="badan hukum">Badan Hukum</option>
                                <option value="instansi">Instansi</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nomor_identitas">Nomor Identitas / Nama Instansi</label>
                            <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas"
                                aria-describedby="nomor_identitas" placeholder="Nomor Identitas / Nama Instansi">
                            {{-- <small id="nomor_identitas" class="form-text text-muted">Kami tidak akan pernah
                                membagikan Identitas Anda kepada orang lain.</small> --}}
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon">Nama Pemohon</label>
                            <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon"
                                aria-describedby="nama_pemohon" placeholder="Nama Pemohon">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Pemohon</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email"
                                placeholder="Email Pemohon">
                        </div>

                        <div class="form-group">
                            <label for="no_telp">Nomor Telpon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                aria-describedby="no_telp" placeholder="Nomor Telepon Pemohon">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Pemohon</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                aria-describedby="pekerjaan" placeholder="Pekerjaan Pemohon">
                        </div>


                        <label for="pekerjaan">Upload Identitas</label>
                        <div class="form-group">
                            <div id="foto-produk-box" class="product-img" style="display: none">
                                <img class="img-fluid" id="foto-produk-src" src="" alt="" width="200">
                            </div>
                            <button id="upload_widget_opener" type="button" class="btn btn-primary">Upload</button>
                            <br>
                            <input type="hidden" id="identity_url" name="identity_url" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <legend class="font-weight-bold">Rincian Permohonan</legend>

                        <div class="form-group">
                            <label for="rincian_informasi">Rincian Informasi</label>
                            <textarea class="form-control" name="rincian_informasi" id="rincian_informasi"
                                rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tujuan_penggunaan_informasi">Tujuan Penggunaan Informasi</label>
                            <textarea class="form-control" name="tujuan_penggunaan_informasi"
                                id="tujuan_penggunaan_informasi" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cara_pemakaian_informasi">Cara Pemakaian Informasi</label>
                            <select class="form-control" id="cara_pemakaian_informasi" name="cara_pemakaian_informasi">
                                <option value="">Pilih</option>
                                <option value="pribadi">Pribadi</option>
                                <option value="bekerja">Bekerja</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cara_memperoleh_informasi">Cara Memperoleh Informasi</label>
                            <select class="form-control" id="cara_memperoleh_informasi"
                                name="cara_memperoleh_informasi">
                                <option value="">Pilih</option>
                                <option value="tradisional">Melihat / Mendengar / Membaca / Mencatat</option>
                                <option value="elektronik">Mendapatkan salinan informasi secara Elektronik</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bentuk_informasi">Bentuk Informasi</label>
                            <select class="form-control" id="bentuk_informasi" name="bentuk_informasi">
                                <option value="">Pilih</option>
                                <option value="softcopy">Softcopy</option>
                                <option value="hardcopy">Hardcopy</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cara_mendapatkan_salinan">Cara Mendapatkan Salinan</label>
                            <select class="form-control" id="cara_mendapatkan_salinan" name="cara_mendapatkan_salinan">
                                <option value="">Pilih</option>
                                <option value="mengambil langsung">Mengambil Langsung</option>
                                <option value="faksimili">Faksimili</option>
                                <option value="email">Email</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Captcha">Captcha</label>
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-sm btn-danger" class="reload" id="reload"
                                    style="font-size:large">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha"
                                name="captcha">
                        </div>

                    </div>
                </div>
                <hr class="styledhr">
                <div class="form-group pb-5">
                    <button type="button" id="savePermohonanBtn" class="btn btn-primary float-right">Ajukan
                        Permohonan</button>
                </div>

            </form>


    </section>

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

        document.getElementById("upload_widget_opener").addEventListener("click", function() {
            myWidget.open();
        }, false);

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