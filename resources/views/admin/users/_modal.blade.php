<!-- Tambah Group -->
<div class="modal fade" id="fModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <form id="fForm" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="judul-modal"></span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modalBox">

                    {{ csrf_field() }}

                    <div class="row card-body">
                        <div class="col-12">

                            <input type="hidden" name="id_user" id="id_user" value="">

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Pas Foto</label>
                                <div class="col-sm-9 profile">
                                    {{-- <div class="profile-edit">
                                        <img class="profile-edit" id="profile_photo_src" src="#" alt="Profile">
                                    </div> --}}

                                    <input class="form-control" type="hidden" name="new-profile_photo"
                                        id="new-profile_photo">
                                    <button type="button" id="cover_image_url_btn"
                                        class="btn btn-secondary btn-sm">Unggah
                                        Foto</button>

                                    <div class="show-cover-box profile-edit" style="display:none;">
                                        <img class="mb-2 rounded-circle " id="preview-cover" src=""
                                            alt="logo_instansi"><br>
                                        <div class="mb-2">
                                            <button type="button" id="retry-cover-btn"
                                                class="btn btn-secondary btn-sm">Unggah Ulang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Username / NIP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">No HP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Peran Pengguna</label>
                                <div class="col-sm-9">
                                    @foreach ($all_roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="roles" name="roles[]"
                                            value="{{ $role }}">
                                        <label class="form-check-label">{{ $role }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row mb-3 box-daerah" style="display:none;">
                                <label class="col-sm-3 col-form-label">Daerah Kab / Kota</label>
                                <div class="col-sm-9">
                                    <select name="kabkota" id="kabkota"
                                        class="form-control form-select select2 @error('kabkota') is-invalid @enderror"
                                        required>
                                        <option value="" disabled selected>Pilih atau Skip</option>
                                        @foreach ($kabkotas as $kabkota)
                                        @if($kabkota->id_kabkota == 0)
                                        <option selected value="{{ $kabkota->id_kabkota }}">{{ $kabkota->name }}
                                        </option>
                                        @else
                                        <option value="{{ $kabkota->id_kabkota }}">{{ $kabkota->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="text-muted edit-state">Kosongkan jika tidak ingin ubah
                                        password</small>
                                </div>
                            </div>

                            <div class="row mb-3 edit-state">
                                <label for="inputText" class="col-sm-3 col-form-label">Block</label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="block" id="block1"
                                            value="yes" checked="">
                                        <label class="form-check-label" for="block1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="block" id="block1" value="no"
                                            checked="">
                                        <label class="form-check-label" for="block1">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 edit-state">
                                <label for="inputText" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1"
                                            value="active" checked="">
                                        <label class="form-check-label" for="status1">
                                            Aktif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1"
                                            value="inactive" checked="">
                                        <label class="form-check-label" for="status1">
                                            Tidak Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>







                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button id="submitBtn" type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>