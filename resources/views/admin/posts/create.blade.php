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
                            <h5 class="card-title">Create {{ $title }}</h5>

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div id="ajax-global-messages"></div>

                            <form id="postForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf

                                {{-- COVER --}}
                                <div class="mb-3">
                                    <label class="title" for="cover">Cover</label>
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <input type="hidden" id="cover_public_id" name="cover_public_id" value="">
                                            <input type="hidden" id="cover_version" name="cover_version" value="">
                                            <input type="hidden" id="cover_ext" name="cover_ext" value="">
                                            <button type="button" id="cover_image_url_btn" class="btn btn-secondary btn-sm">Unggah Cover</button>
                                        </div>

                                        <div class="show-cover-box" style="display:none;">
                                            <img id="preview-cover" src="" alt="preview cover" style="max-height:200px; display:block;" class="mb-2">
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
                                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_featured">Featured</label>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_recommended" name="is_recommended" {{ old('is_recommended') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_recommended">Recommended</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_breaking" name="is_breaking" {{ old('is_breaking') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_breaking">Breaking News</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_slider" name="is_slider" {{ old('is_slider') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_slider">Slider</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- TITLE --}}
                                <div class="mb-3">
                                    <label class="title" for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                    <div class="invalid-feedback" id="error-title"></div>
                                </div>

                                {{-- DESCRIPTION --}}
                                <div class="mb-3">
                                    <label class="title" for="desc">Description</label>
                                    <textarea name="desc" id="desc" cols="50" rows="10" class="form-control tinymce-editor">{{ old('desc') }}</textarea>
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
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
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
                                            <option value="" disabled selected>Pilih atau Skip</option>
                                            @foreach ($kabkotas as $kabkota)
                                                <option value="{{ $kabkota->id_kabkota }}" @if ($kabkota->id_kabkota == 0) selected @endif>
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
                                    <input type="text" name="keywords" id="keywords" class="form-control" value="{{ old('keywords') }}">
                                    <div class="invalid-feedback" id="error-keywords"></div>
                                </div>

                                {{-- META DESC --}}
                                <div class="mb-3">
                                    <label class="title" for="meta_desc">Meta Desc</label>
                                    <textarea class="form-control" name="meta_desc" id="meta_desc" cols="5" rows="3">{{ old('meta_desc') }}</textarea>
                                    <div class="invalid-feedback" id="error-meta_desc"></div>
                                </div>

                                {{-- EDITOR & PHOTOGRAPHER --}}
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label class="title" for="editor">Editor</label>
                                        <input type="text" name="editor" id="editor" class="form-control" value="{{ old('editor') }}" placeholder="Nama Editor">
                                        <div class="invalid-feedback" id="error-editor"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="title" for="photographer">Fotografer</label>
                                        <input type="text" name="photographer" id="photographer" class="form-control" value="{{ old('photographer') }}" placeholder="Nama Fotografer">
                                        <div class="invalid-feedback" id="error-photographer"></div>
                                    </div>
                                </div>

                                {{-- ACTIONS --}}
                                <div class="d-flex justify-content-between">
                                    <a href="{{ URL::previous() }}" class="btn btn-warning">Cancel</a>
                                    <button type="submit" id="btn-submit" class="btn btn-primary">Submit</button>
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
    {{-- Library CSS/JS already included in _styles where applicable --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{-- Buttons / datatables extras if needed --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>


    <script>
        // -------------------------
        // Utilities
        // -------------------------
        function setValidationError(fieldName, message) {
            // replace dot/array notation to valid selector
            var safeName = fieldName.replace(/\./g, '\\.').replace(/\[/g, '\\[').replace(/\]/g, '\\]');
            var $el = $('[name="' + fieldName + '"]');
            if (!$el.length) {
                // try alternative selector for array style like tags[] etc
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
                // global message
                $('#ajax-global-messages').append('<div class="alert alert-danger ajax-global-error">' + message + '</div>');
            }
        }

        function clearValidationErrors() {
            $('#ajax-global-messages').html('');
            $('#postForm').find('.is-invalid').removeClass('is-invalid');
            $('#postForm').find('.invalid-feedback').each(function() {
                // keep existing server side inline messages? remove all dynamic ones
                $(this).text('');
                $(this).hide();
            });
        }

        // parse Cloudinary secure_url to get public_id, version, ext
        function parseCloudinaryUrl(url) {
            if (!url) return null;

            // pastikan string
            url = url.toString().trim();

            // split by slash
            var parts = url.split('/');

            // typical Cloudinary: https://res.cloudinary.com/{cloud}/image/upload/{version}/{path...}/{file.ext}
            // cari index 'upload'
            var uploadIndex = parts.indexOf('upload');
            if (uploadIndex === -1) return null;

            // version biasanya di uploadIndex + 1 (ex: v1757984949)
            var versionPart = parts[uploadIndex + 1] && parts[uploadIndex + 1].startsWith('v') ? parts[uploadIndex + 1] : null;

            // public_id + ext mulai dari uploadIndex + 2
            var publicWithExtArr = parts.slice(uploadIndex + 2); // ["PandanViewMandeh", "Flyer_Natourtravel_wjegxz.jpg"]
            if (publicWithExtArr.length === 0) return null;

            var publicWithExt = publicWithExtArr.join('/'); // "PandanViewMandeh/Flyer_Natourtravel_wjegxz.jpg"

            // ambil ekstensi (jpg/png/..)
            var extMatch = publicWithExt.match(/\.([a-zA-Z0-9]+)$/);
            var ext = extMatch ? extMatch[1] : '';

            // public_id tanpa ekstensi
            var publicId = publicWithExt.replace(/\.[^/.]+$/, ''); // "PandanViewMandeh/Flyer_Natourtravel_wjegxz"

            return {
                public_id: publicId,
                version: versionPart, // bisa null jika tidak ada
                ext: ext // mis. "jpg"
            };
        }

        // -------------------------
        // Document ready
        // -------------------------
        $(function() {
            // CSRF for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
            tinymce.init({
                selector: 'textarea.tinymce-editor, textarea#desc',
                resize: false,
                plugins: [
                    'lists', // bullet/number list
                    'autolink' // otomatis link jika user mengetik (tidak memberi tombol insert link)
                ],
                menubar: 'edit format tools table help',
                toolbar: 'fullscreen | undo redo | bold italic underline strikethrough | blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | pagebreak ',
                toolbar_sticky: true,
                toolbar_sticky_offset: isSmallScreen ? 102 : 108,
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_prefix: '{path}{query}-{id}-',
                autosave_restore_when_empty: false,
                autosave_retention: '2m',
                image_advtab: true,
                branding: false,
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 500,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                contextmenu: 'link image table',
                skin: useDarkMode ? 'oxide-dark' : 'oxide',
                content_css: useDarkMode ? 'dark' : 'default',
                // content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });

            // Auto-sync TinyMCE contents into textarea before any AJAX form submit.
            // Jika form id berbeda, sesuaikan selector '#postForm'
            document.addEventListener('submit', function(e) {
                try {
                    if (typeof tinymce !== 'undefined') {
                        // jika ada specific editor id #desc
                        if (tinymce.get('desc')) {
                            tinymce.get('desc').save(); // copy content ke textarea#desc
                        } else {
                            // untuk semua editor di halaman
                            tinymce.triggerSave();
                        }
                    }
                } catch (err) {
                    console.warn('TinyMCE save skipped', err);
                }
                // biarkan event submit lanjut (AJAX handler di form akan membuat FormData dari textarea yang sudah terupdate)
            }, true); // capture phase to run before other submit handlers

            // init select2
            $('.select2').select2({
                theme: 'bootstrap-5'
            });

            // init select2 tags example (if you later enable)
            $('.select2-tags').select2({
                theme: 'bootstrap-5',
                placeholder: 'Cari Tag',
                language: {
                    noResults: function() {
                        return "Tidak ditemukan <a class='btn btn-sm btn-danger add-new-tag'>Tambahkan</a>";
                    }
                },
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

            // add-new-tag handler (if used)
            $(document).on('click', '.add-new-tag', function(e) {
                e.preventDefault();
                var tagName = $('.select2-search__field').val();
                if (!tagName) return;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('tag.add') }}',
                    data: {
                        tag_name: tagName
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success && data.data) {
                            var dt = data.data;
                            var newOption = new Option(dt.name, dt.id, true, true);
                            $('.select2-tags').append(newOption).trigger('change');
                        } else {
                            Swal.fire('Error!', data.message || 'Gagal menambah tag', 'error');
                        }
                    },
                    error: function(err) {
                        if (err.status === 422 && err.responseJSON && err.responseJSON.errors) {
                            var first = Object.values(err.responseJSON.errors)[0][0];
                            Swal.fire('Validation', first, 'warning');
                        } else if (err.status === 403) {
                            Swal.fire('Unauthorized', 'Anda tidak berhak melakukan aksi ini', 'warning');
                        } else {
                            Swal.fire('Error', 'Terjadi kesalahan', 'error');
                        }
                    }
                });
            });

            // Cloudinary widget
            var coverWidget = cloudinary.createUploadWidget({
                cloudName: 'dezj1x6xp',
                uploadPreset: 'pandanviewmandeh',
                theme: 'minimal',
                multiple: false,
                max_file_size: 10048576,
                background: "white",
                // quality: 20 // optional
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
            // FORM SUBMIT via AJAX
            // -------------------------
            $('#postForm').on('submit', function(e) {
                e.preventDefault();
                clearValidationErrors();

                var $btn = $('#btn-submit');
                var originalText = $btn.html();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

                var form = document.getElementById('postForm');
                var formData = new FormData(form);

                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method') || 'POST',
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
                                text: res.message || 'Data berhasil disimpan',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(function() {
                                if (res.redirect) {
                                    window.location.href = res.redirect;
                                } else {
                                    window.location.href = "{{ URL::previous() }}";
                                }
                            });
                        } else {
                            // fallback: server returned 200 but not success
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
                            // scroll to first invalid
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
