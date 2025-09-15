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
                <input type="hidden" name="id_permohonan" id="id_permohonan" value="">

                <div class="modal-body">


                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <legend style="font-size:larger !important" class="font-weight-bold">Identitas Pemohon
                            </legend>

                            <div class="form-group mb-3">
                                <label for="jenis_pemohon">Jenis Pemohon</label>
                                <select class="form-control" id="jenis_pemohon" disabled name="jenis_pemohon">
                                    <option value="">Pilih</option>
                                    <option value="pribadi">Pribadi</option>
                                    <option value="kelompok">Kelompok</option>
                                    <option value="badan hukum">Badan Hukum</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jenis_identitas">Jenis Identitas</label>
                                <select class="form-control" id="jenis_identitas" disabled name="jenis_identitas">
                                    <option value="">Pilih</option>
                                    <option value="ktp">KTP</option>
                                    <option value="surat kuasa">Surat Kuasa</option>
                                    <option value="badan hukum">Badan Hukum</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="nomor_identitas">Nomor Identitas</label>
                                <input type="text" class="form-control" id="nomor_identitas" disabled
                                    name="nomor_identitas" aria-describedby="nomor_identitas"
                                    placeholder="Nomor Identitas">
                            </div>

                            <div class="form-group mb-3">
                                <label for="nama_pemohon">Nama Pemohon</label>
                                <input type="text" class="form-control" id="nama_pemohon" disabled name="nama_pemohon"
                                    aria-describedby="nama_pemohon" placeholder="Nama Pemohon">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email Pemohon</label>
                                <input type="email" class="form-control" id="email" disabled name="email"
                                    aria-describedby="email" placeholder="Email Pemohon">
                            </div>

                            <div class="form-group mb-3">
                                <label for="no_telp">Nomor Telpon</label>
                                <input type="text" class="form-control" id="no_telp" disabled name="no_telp"
                                    aria-describedby="no_telp" placeholder="Nomor Telepon Pemohon">
                            </div>

                            <div class="form-group mb-3">
                                <label for="alamat">Alamat Pemohon</label>
                                <textarea class="form-control" name="alamat" id="alamat" disabled rows="3"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" disabled name="pekerjaan"
                                    aria-describedby="pekerjaan" placeholder="Pekerjaan Pemohon">
                            </div>



                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <legend style="font-size:larger !important" class="font-weight-bold">Rincian Permohonan
                            </legend>

                            <div class="form-group mb-3">
                                <label for="rincian_informasi">Rincian Informasi</label>
                                <textarea class="form-control" name="rincian_informasi" id="rincian_informasi" disabled
                                    rows="3"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tujuan_penggunaan_informasi">Tujuan Penggunaan Informasi</label>
                                <textarea class="form-control" name="tujuan_penggunaan_informasi"
                                    id="tujuan_penggunaan_informasi" disabled rows="3"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="cara_pemakaian_informasi">Cara Pemakaian Informasi</label>
                                <select class="form-control" id="cara_pemakaian_informasi" disabled
                                    name="cara_pemakaian_informasi">
                                    <option value="">Pilih</option>
                                    <option value="pribadi">Pribadi</option>
                                    <option value="bekerja">Bekerja</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="cara_memperoleh_informasi">Cara Memperoleh Informasi</label>
                                <select class="form-control" id="cara_memperoleh_informasi" disabled
                                    name="cara_memperoleh_informasi">
                                    <option value="">Pilih</option>
                                    <option value="tradisional">Melihat / Mendengar / Membaca / Mencatat</option>
                                    <option value="elektronik">Mendapatkan salinan informasi secara Elektronik</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="bentuk_informasi">Bentuk Informasi</label>
                                <select class="form-control" id="bentuk_informasi" disabled name="bentuk_informasi">
                                    <option value="">Pilih</option>
                                    <option value="softcopy">Softcopy</option>
                                    <option value="hardcopy">Hardcopy</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="cara_mendapatkan_salinan">Cara Mendapatkan Salinan</label>
                                <select class="form-control" id="cara_mendapatkan_salinan" disabled
                                    name="cara_mendapatkan_salinan">
                                    <option value="">Pilih</option>
                                    <option value="mengambil langsung">Mengambil Langsung</option>
                                    <option value="faksimili">Faksimili</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="pekerjaan">Data Identitas</label><br>

                                <a href="#" target="_blank" id="identity_url" type="button"
                                    class="btn btn-primary">Lihat Data</a>
                            </div>


                        </div>
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