@extends('layouts.admin.master')
@section('title', $title)

@section('_styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }

        .select2def {
            border: 1px solid #ced4da !important;
        }

        .txtgray {
            color: gray !important;
            font-size: small !important;
        }

        .select2-container .select2-selection--single {
            height: 34px !important;
        }

        label.title {
            font-weight: bolder;
        }

        .ajax-global-error {
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{ $br1 }}</a></li>
                    <li class="breadcrumb-item active">{{ $br2 }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit {{ $title }}</h5>

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div id="ajax-global-messages"></div>

                            <form id="postForm" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')

                                {{-- COVER --}}
                                <div class="mb-3">
                                    <label class="title" for="cover">Cover</label>
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <input type="hidden" id="cover_public_id" name="cover_public_id" value="{{ old('cover_public_id', $post->cover_public_id ?? '') }}">
                                            <input type="hidden" id="cover_version" name="cover_version" value="{{ old('cover_version', $post->cover_version ?? '') }}">
                                            <input type="hidden" id="cover_ext" name="cover_ext" value="{{ old('cover_ext', $post->cover_ext ?? '') }}">
                                            <button type="button" id="cover_image_url_btn" class="btn btn-secondary btn-sm">Unggah Cover</button>
                                        </div>

                                        <div class="show-cover-box" style="{{ $post->cover_url ? 'display:block;' : 'display:none;' }}">
                                            <img id="preview-cover" src="{{ $post->cover_url ?? '' }}" alt="preview cover" style="max-height:200px; display:block;" class="mb-2">
                                            <div><button type="button" id="retry-cover-btn" class="btn btn-secondary btn-sm">Unggah Ulang</button></div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback d-block" id="error-cover" style="display:none;"></div>
                                </div>

                                {{-- HIGHLIGHTS --}}
                                <div class="mb-3 row">
                                    <label class="title col-12" for="highlights">Highlights</label>

                                    @if (!Auth::user()->hasRole('kontributor_daerah'))
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_featured">Featured</label>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_recommended" name="is_recommended" {{ old('is_recommended', $post->is_recommended) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_recommended">Recommended</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_breaking" name="is_breaking" {{ old('is_breaking', $post->is_breaking) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_breaking">Breaking News</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_slider" name="is_slider" {{ old('is_slider', $post->is_slider) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_slider">Slider</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- TITLE --}}
                                <div class="mb-3">
                                    <label class="title" for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                                    <div class="invalid-feedback" id="error-title"></div>
                                </div>

                                {{-- DESCRIPTION --}}
                                <div class="mb-3">
                                    <label class="title" for="desc">Description</label>
                                    <textarea name="desc" id="desc" cols="50" rows="10" class="form-control tinymce-editor">{{ old('desc', $post->desc) }}</textarea>
                                    <div class="invalid-feedback" id="error-desc"></div>
                                </div>

                                {{-- CATEGORY --}}
                                @if (app('request')->has('category'))
                                    <div class="mb-3">
                                        <label class="title" for="category">Category</label>
                                        <input class="form-control" type="text" value="{{ ucwords($category) }}" disabled>
                                        <input type="hidden" name="category" id="category" value="{{ $categoryID }}">
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <label class="title" for="category">Category</label>
                                        <select name="category" id="category" class="form-select select2">
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ (int) old('category', $post->category_id ?? $post->category) === $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback" id="error-category"></div>
                                    </div>
                                @endif

                                {{-- KABKOTA --}}
                                <div class="mb-3">
                                    <label class="title" for="kabkota">Kabupaten / Kota</label>

                                    @if (Auth::user()->hasRole('kontributor_daerah'))
                                        <input type="hidden" name="kabkota" id="kabkota" value="{{ Auth::user()->kabkota->id_kabkota }}">
                                        <input class="form-control" type="text" id="kabkota_text" value="{{ Auth::user()->kabkota->name }}" disabled readonly>
                                    @else
                                        <select name="kabkota" id="kabkota" class="form-select">
                                            <option value="" disabled>Pilih atau Skip</option>
                                            @foreach ($kabkotas as $kabkota)
                                                <option value="{{ $kabkota->id_kabkota }}" {{ (string) old('kabkota', $post->kabkota) === (string) $kabkota->id_kabkota ? 'selected' : '' }}>
                                                    {{ $kabkota->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback" id="error-kabkota"></div>
                                    @endif
                                </div>

                                {{-- KEYWORDS --}}
                                <div class="mb-3">
                                    <label class="title" for="keywords">Keywords</label>
                                    <input type="text" name="keywords" id="keywords" class="form-control" value="{{ old('keywords', $post->keywords) }}">
                                    <div class="invalid-feedback" id="error-keywords"></div>
                                </div>

                                {{-- META DESC --}}
                                <div class="mb-3">
                                    <label class="title" for="meta_desc">Meta Desc</label>
                                    <textarea class="form-control" name="meta_desc" id="meta_desc" cols="5" rows="3">{{ old('meta_desc', $post->meta_desc) }}</textarea>
                                    <div class="invalid-feedback" id="error-meta_desc"></div>
                                </div>

                                {{-- EDITOR & PHOTOGRAPHER --}}
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label class="title" for="editor">Editor</label>
                                        <input type="text" name="editor" id="editor" class="form-control" value="{{ old('editor', $post->editor) }}" placeholder="Nama Editor">
                                        <div class="invalid-feedback" id="error-editor"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="title" for="photographer">Fotografer</label>
                                        <input type="text" name="photographer" id="photographer" class="form-control" value="{{ old('photographer', $post->photographer) }}" placeholder="Nama Fotografer">
                                        <div class="invalid-feedback" id="error-photographer"></div>
                                    </div>
                                </div>

                                {{-- ACTIONS --}}
                                <div class="d-flex justify-content-between">
                                    <a href="{{ URL::previous() }}" class="btn btn-warning">Cancel</a>
                                    <button type="submit" id="btn-submit" class="btn btn-primary">Update</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('admin.posts._modal')
    </main>
@endsection

@section('_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>

    <script>
        // -------------------------
        // Utilities (same as create)
        // -------------------------
        function setValidationError(fieldName, message) {
            var safeName = fieldName.replace(/\./g, '\\.').replace(/\[/g, '\\[').replace(/\]/g, '\\]');
            var $el = $('[name="' + fieldName + '"]');
            if (!$el.length) {
                $el = $('[name="' + safeName + '"]');
            }
            if ($el.length) {
                $el.addClass('is-invalid');
                var id = 'error-' + fieldName.replace(/[\[\].]/g, '_');
                if ($('#' + id).length) {
                    $('#' + id).text(message).show();
                } else {
                    $el.after('<div class="invalid-feedback" id="' + id + '">' + message + '</div>');
                }
            } else {
                $('#ajax-global-messages').append('<div class="alert alert-danger ajax-global-error">' + message + '</div>');
            }
        }

        function clearValidationErrors() {
            $('#ajax-global-messages').html('');
            $('#postForm').find('.is-invalid').removeClass('is-invalid');
            $('#postForm').find('.invalid-feedback').each(function() {
                $(this).text('').hide();
            });
        }

        function parseCloudinaryUrl(url) {
            if (!url) return null;
            url = url.toString().trim();
            var parts = url.split('/');
            var uploadIndex = parts.indexOf('upload');
            if (uploadIndex === -1) return null;
            var versionPart = parts[uploadIndex + 1] && parts[uploadIndex + 1].startsWith('v') ? parts[uploadIndex + 1] : null;
            var publicWithExtArr = parts.slice(uploadIndex + 2);
            if (publicWithExtArr.length === 0) return null;
            var publicWithExt = publicWithExtArr.join('/');
            var extMatch = publicWithExt.match(/\.([a-zA-Z0-9]+)$/);
            var ext = extMatch ? extMatch[1] : '';
            var publicId = publicWithExt.replace(/\.[^/.]+$/, '');
            return {
                public_id: publicId,
                version: versionPart,
                ext: ext
            };
        }

        // -------------------------
        // Document ready
        // -------------------------
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // init TinyMCE minimal (only paragraph formatting etc.)
            const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
            tinymce.init({
                selector: 'textarea.tinymce-editor, textarea#desc',
                menubar: false,
                statusbar: false,
                branding: false,
                height: 500,
                plugins: ['lists', 'paste', 'autolink'],
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat',
                paste_as_text: true,
                forced_root_block: 'p',
                elementpath: false,
                content_style: "body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial; font-size:14px }",
                skin: useDarkMode ? 'oxide-dark' : 'oxide',
                content_css: useDarkMode ? 'dark' : 'default'
            });

            // auto sync tinymce before submit
            document.addEventListener('submit', function(e) {
                try {
                    if (typeof tinymce !== 'undefined') {
                        if (tinymce.get('desc')) tinymce.get('desc').save();
                        else tinymce.triggerSave();
                    }
                } catch (err) {
                    console.warn('TinyMCE save skipped', err);
                }
            }, true);

            // init select2
            $('.select2').select2({
                theme: 'bootstrap-5'
            });

            // Cloudinary widget (same cloud/preset)
            var coverWidget = cloudinary.createUploadWidget({
                cloudName: 'dezj1x6xp',
                uploadPreset: 'pandanviewmandeh',
                theme: 'minimal',
                multiple: false,
                max_file_size: 10048576,
                background: "white",
            }, function(error, result) {
                if (!error && result && result.event === "success") {
                    var info = result.info;
                    var url = info.secure_url;
                    var parsed = parseCloudinaryUrl(url);
                    if (parsed) {
                        $('#cover_public_id').val(parsed.public_id);
                        $('#cover_version').val(parsed.version || '');
                        $('#cover_ext').val(parsed.ext || '');
                    }
                    $('#cover_image_url_btn').hide();
                    $('.show-cover-box').show();
                    $('#preview-cover').attr('src', url);
                } else if (error) {
                    console.error('Cloudinary error', error);
                    Swal.fire('Upload error', 'Gagal mengunggah cover', 'error');
                }
            });

            // If post already has cover which is a URL, hide upload button and show preview (server already set preview src)
            @if (!empty($post->cover))
                // hide upload button (let user retry if wants)
                $('#cover_image_url_btn').hide();
                $('.show-cover-box').show();
            @endif

            $('#cover_image_url_btn').on('click', function(e) {
                e.preventDefault();
                coverWidget.open();
            });

            $(document).on('click', '#retry-cover-btn', function(e) {
                e.preventDefault();
                $('#cover_image_url_btn').show();
                $('.show-cover-box').hide();
                $('#cover_public_id, #cover_version, #cover_ext').val('');
            });

            // -------------------------
            // FORM SUBMIT via AJAX (update)
            // -------------------------
            $('#postForm').on('submit', function(e) {
                e.preventDefault();
                clearValidationErrors();

                var $btn = $('#btn-submit');
                var originalText = $btn.html();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

                var form = document.getElementById('postForm');
                var formData = new FormData(form);

                // ensure method spoof for PUT is included (blade added @method('PUT') which creates _method hidden field)
                // if not present, add it:
                if (!formData.has('_method')) {
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: $(form).attr('action'),
                    method: 'POST', // always POST with method spoofing
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(res) {
                        $btn.prop('disabled', false).html(originalText);

                        if (res.success || res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'Perubahan berhasil disimpan',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(function() {
                                if (res.redirect) {
                                    window.location.href = res.redirect;
                                } else {
                                    // go back to previous page or to posts index
                                    window.location.href = "{{ URL::previous() }}";
                                }
                            });
                        } else {
                            Swal.fire('Error', res.message || 'Terjadi kesalahan saat menyimpan', 'error');
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html(originalText);

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                setValidationError(key, errors[key][0]);
                            });
                            var $first = $('.is-invalid').first();
                            if ($first.length) {
                                $('html, body').animate({
                                    scrollTop: $first.offset().top - 100
                                }, 250);
                            }
                        } else if (xhr.status === 419) {
                            Swal.fire('Session expired', 'Sesi Anda mungkin telah berakhir. Silakan muat ulang halaman.', 'warning');
                        } else {
                            var msg = 'Terjadi kesalahan. (' + xhr.status + ')';
                            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                            Swal.fire('Error', msg, 'error');
                        }
                    }
                });

            }); // end submit

        }); // end ready
    </script>
@endsection
