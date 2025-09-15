<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_permohonan', function (Blueprint $table) {
            $table->increments('id_permohonan');
			$table->timestamps();
			$table->softDeletes();

            $table->unsignedInteger('user_id')->nullable();
            $table->string('nomor_permohonan')->nullable();
            $table->enum('jenis_pemohon', ['pribadi', 'kelompok', 'badan hukum'])->default('pribadi');
            $table->enum('jenis_identitas', ['ktp', 'surat kuasa', 'badan hukum', 'instansi'])->default('ktp');
            $table->string('nomor_identitas')->nullable();

            $table->string('nama_pemohon')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->text('alamat');
            $table->string('pekerjaan')->nullable();
            
            $table->text('identity_url')->nullable();
            $table->text('rincian_informasi')->nullable();
            $table->text('tujuan_penggunaan_informasi')->nullable();

            
            $table->enum('cara_pemakaian_informasi', ['pribadi', 'bekerja', 'lainnya'])->default('pribadi');
            $table->enum('cara_memperoleh_informasi', ['tradisional', 'elektronik'])->default('tradisional');
            $table->enum('bentuk_informasi', ['softcopy', 'hardcopy'])->default('softcopy');


            $table->enum('cara_mendapatkan_salinan', ['mengambil langsung', 'faksimili', 'email'])->default('mengambil langsung');
            $table->enum('status_permohonan', ['baru', 'proses', 'selesai', 'batal'])->default('baru');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_permohonan');
    }
}
