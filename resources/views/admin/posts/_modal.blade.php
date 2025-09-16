<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">


<style>
    /* Paksa modal jadi fullscreen penuh */
    .modal-dialog.modal-fullscreen,
    .modal-fullscreen {
        width: 100% !important;
        max-width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        transform: none !important;
        padding: 0 !important;
    }

    .modal-fullscreen .modal-content,
    .modal-dialog.modal-fullscreen .modal-content {
        display: flex;
        flex-direction: column;
        /* biar header, body, footer tersusun vertikal */
        /* height: 100vh !important; */
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .modal-fullscreen .modal-header,
    .modal-fullscreen .modal-footer {
        flex-shrink: 0;
        /* header/footer tetap tinggi normal */
    }

    .modal-fullscreen .modal-body,
    .modal-dialog.modal-fullscreen .modal-body {
        flex: 1 1 auto;
        /* body mengisi ruang sisa */
        overflow-y: auto;
        /* scroll kalau isi kepanjangan */
        height: auto !important;
        /* hilangkan batasan fixed */
        max-height: none !important;
    }
</style>


<!-- Tambah / Edit Group (Modal Fullscreen) -->
<div class="modal fade" id="tambahGroup" tabindex="-1" role="dialog" aria-labelledby="tambahGroupLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-fullscreen" role="document">
        <form id="groupForm" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_post" id="id_post" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="judul-modal">Tambah</span> {{ $title ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modalBox">
                    <div class="row card-body">
                        <div class="col-12">

                            {{-- Cover --}}
                            <div class="form-group mb-3">
                                <label class="title" for="cover">Cover</label>

                                <div class="col-sm-10">
                                    {{-- <input class="form-control" type="hidden" name="cover" id="cover"> --}}
                                    <button type="button" id="cover_image_url_btn" class="btn btn-secondary btn-sm">Unggah Cover</button>

                                    <div class="show-cover-box" style="display:none; margin-top:10px;">
                                        <img class="mb-2" id="preview-cover" src="" alt="cover" style="max-height:260px; width:auto;"><br>
                                        <div class="mb-2">
                                            <button type="button" id="retry-cover-btn" class="btn btn-secondary btn-sm">Unggah Ulang</button>
                                        </div>
                                        <!-- hidden input di form -->
                                        <input type="hidden" id="cover_public_id" name="cover_public_id" value="">
                                        <input type="hidden" id="cover_version" name="cover_version" value="">
                                        <input type="hidden" id="cover_ext" name="cover_ext" value="">
                                    </div>
                                </div>
                                @error('cover')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Highlights --}}
                            <div class="form-group mb-3 row">
                                <label class="title" for="highlights" class="col-12">Highlights</label>

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

                            {{-- Title --}}
                            <div class="form-group mb-3">
                                <label class="title" for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="form-group mb-3">
                                <label class="title" for="desc">Description</label>
                                {{-- <textarea name="desc" id="desc" cols="50" rows="10" class="form-control @error('desc') is-invalid @enderror" required>{{ old('desc') ? htmlspecialchars(old('desc')) : '' }}</textarea> --}}
                                <textarea class="tinymce-editor">
                                    {!! old('desc') !!}
                                </textarea><!-- End TinyMCE Editor -->
                                @error('desc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            @if (app('request')->has('category'))
                                <div class="form-group mb-3">
                                    <label class="title" for="category">Category</label>
                                    <input class="form-control" type="text" value="{{ ucwords($category) }}" disabled>
                                    <input type="hidden" name="category" id="category" value="{{ $categoryID }}">
                                </div>
                            @else
                                <div class="form-group mb-3">
                                    <label class="title" for="category">Category</label>
                                    <select name="category" id="category" class="form-control form-select select2 @error('category') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            {{-- Kabupaten / Kota --}}
                            <div class="form-group mb-3">
                                <label class="title" for="kabkota">Kabupaten / Kota</label>

                                @if (Auth::user()->hasRole('kontributor_daerah'))
                                    <input type="hidden" name="kabkota" id="kabkota" value="{{ Auth::user()->kabkota->id_kabkota }}">
                                    <input class="form-control" type="text" name="kabkota_text" id="kabkota_text" value="{{ Auth::user()->kabkota->name }}" disabled readonly>
                                @else
                                    {{-- <select name="kabkota" id="kabkota" class="form-control form-select select2 @error('kabkota') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih atau Skip</option>
                                        @foreach ($kabkotas as $kab)
                                            <option value="{{ $kab->id_kabkota }}">{{ $kab->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select name="kabkota" id="kabkota" class="form-select @error('kabkota') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih atau Skip</option>
                                        @foreach ($kabkotas as $kab)
                                            <option value="{{ $kab->id_kabkota }}">{{ $kab->name }}</option>
                                        @endforeach
                                    </select>

                                @endif

                                @error('kabkota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Keywords --}}
                            <div class="form-group mb-3">
                                <label class="title" for="keywords">Keywords</label>
                                <input type="text" name="keywords" id="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords') }}" required>
                                @error('keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Meta Desc --}}
                            <div class="form-group mb-3">
                                <label class="title" for="meta_desc">Meta Desc</label>
                                <textarea class="form-control" name="meta_desc" id="meta_desc" cols="5" rows="5" required>{{ old('meta_desc') }}</textarea>
                                @error('meta_desc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Editor & Photographer --}}
                            <div class="form-group mb-3 row">
                                <div class="col-md-6">
                                    <label class="title" for="editor">Editor</label>
                                    <input type="text" name="editor" id="editor" class="form-control @error('editor') is-invalid @enderror" value="{{ old('editor') }}" placeholder="Nama Editor">
                                    @error('editor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="title" for="photographer">Fotografer</label>
                                    <input type="text" name="photographer" id="photographer" class="form-control @error('photographer') is-invalid @enderror" value="{{ old('photographer') }}" placeholder="Nama Fotografer">
                                    @error('photographer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div> {{-- .col-12 --}}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- tombol submit di-handle via JS (ajax) sehingga type="button" --}}
                    <button id="submitGroupBtn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>




<script>
    // Cover
    var coverWidget = cloudinary.createUploadWidget({
        cloudName: 'dezj1x6xp',
        uploadPreset: 'pandanviewmandeh',
        theme: 'minimal',
        multiple: false,
        max_file_size: 10048576,
        background: "white",
        quality: 20
    }, (error, result) => {
        if (!error && result && result.event === "success") {
            console.log('Info Arsip Masuk: ', result.info);
            var linklogo = result.info.secure_url;
            // $('#cover').val(linklogo);
            console.log('linklogo: ' + linklogo);
            var parsed = parseCloudinaryUrl(linklogo);
            if (parsed) {

                // isi hidden input sebelum submit ajax/form biasa
                $('#cover_public_id').val(parsed.public_id);
                $('#cover_version').val(parsed.version || '');
                $('#cover_ext').val(parsed.ext || '');

                console.log('public_id: ' + parsed.public_id);
                console.log('version: ' + parsed.version);
                console.log('ext: ' + parsed.ext);
            }

            $('#cover_image_url_btn').hide();

            $('.show-cover-box').show();
            $('#preview-cover').attr("src", linklogo);

        }
    });

    document.getElementById("cover_image_url_btn").addEventListener("click", function() {
        coverWidget.open();
    }, false);

    $(document).on('click', '#retry-cover-btn', function(e) {
        $('#cover_image_url_btn').show();
        $('.show-cover-box').hide();
    });

    // contoh fungsi: parse cloudinary secure_url -> ambil public_id, version, ext
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

    $('#kabkota').select2({
        dropdownParent: $('#tambahGroup'),
        width: '100%'
    });
</script>
