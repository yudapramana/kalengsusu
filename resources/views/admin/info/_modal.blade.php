<div class="modal fade" id="defModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="modalTitle"></span></h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
            <form role="form" id="defForm" autocomplete="off" method="post" enctype="multipart/form-data">
                <!-- CSRF TOKEN -->
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_data_file" id="id_data_file" value="">

                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="id_data_klasifikasi">Klasifikasi</label>
                                <select class="form-control select2 select2bs4 select2def" id="id_data_klasifikasi"
                                    name="id_data_klasifikasi" style="width: 100%;" required>
                                    <option value="">Pilih Klasifikasi</option>
                                    @foreach($klasifikasi_s as $jenis)
                                    <option value="{{$jenis->id_data_klasifikasi}}">{{$jenis->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="id_data_sub_klasifikasi">SubKlasifikasi
                                    Data</label>
                                <select class="form-control select2 select2bs4 select2def" id="id_data_sub_klasifikasi"
                                    name="id_data_sub_klasifikasi" style="width: 100%;" required>
                                    <option value="">Pilih SubKlasifikasi</option>
                                    @foreach($subklasifikasi_s as $klas)
                                    <option value="{{$klas->id_data_sub_klasifikasi}}">{{$klas->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="id_data_kategori">Kategori Data</label>
                                <select class="form-control select2 select2bs4 select2-search-kategori"
                                    id="id_data_kategori" name="id_data_kategori" style="width: 100%;" required>
                                    <option value="">Belum Diketahui</option>
                                    @foreach($kategori_s as $kat)
                                    <option value="{{$kat->id_data_kategori}}">{{$kat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="id_data_instansi">Instansi / Seksi</label>
                                <select class="form-control select2 select2bs4 select2-search-instansi"
                                    id="id_data_instansi" name="id_data_instansi" style="width: 100%;" required>
                                    <option value="">Belum Diketahui</option>
                                    @foreach($instansi_s as $instansi)
                                    <option value="{{$instansi->id_data_instansi}}">{{$instansi->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="penanggung_jawab">Jabatan Penanggung Jawab</label>
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                    placeholder="Penanggung Jawab" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="tempat">Tempat</label>
                                <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat"
                                    required>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="akses">Akses dari Data</label>
                                <select class="form-control select2 select2bs4 select2def" id="akses" name="akses"
                                    style="width: 100%;" required>
                                    <option value="">Pilih Tipe Akses</option>
                                    <option value="public">Public</option>
                                    <option value="private">Private / Internal</option>
                                    <option value="user">User Individual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="bentuk">Bentuk Data</label>
                                <select class="form-control select2 select2bs4 select2def" id="bentuk" name="bentuk"
                                    style="width: 100%;" required>
                                    <option value="">Pilih Bentuk Data</option>
                                    <option value="cetak">Cetak</option>
                                    <option value="online">Online</option>
                                    <option value="rekam">Rekam</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="nama_file">Nama File</label>
                                <input type="text" class="form-control" id="nama_file" name="nama_file"
                                    placeholder="Nama Label" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="tahun">Tahun</label>
                                <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="mb-3 form-group">
                                <label style="font-weight: bold" for="nama">Judul / Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="data_file_required" id="data_file_required" value="true">
                    <div class="mb-3 form-group berkas-upload">
                        <label style="font-weight: bold" for="nama">Berkas Lama</label><br>
                        <div class="alert alert-dark outline">
                            <u><a id="string_url" target="_blank" href="javascript:void(0)"></a></u>
                            <br>
                            <span id="string_keterangan"></span>
                        </div>

                    </div>

                    <div class="mb-3 form-group">
                        <label style="font-weight: bold" for="nama">Unggah Berkas Baru <span class="text-muted"
                                style="font-size:smaller;">(Opsional Jika
                                Edit)</span></label>
                        <input type="file" name="data_file" id="data_file">
                    </div>



                </div>

                <div class="modal-footer justify-content-between">

                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->