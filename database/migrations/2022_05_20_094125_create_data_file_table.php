<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_data_file', function (Blueprint $table) {
            $table->increments('id_data_file');
			$table->timestamps();
			$table->softDeletes();
            $table->string('created_by')->default('');
            $table->string('updated_by')->default('');

            $table->unsignedInteger('id_data_instansi')->nullable();
            $table->unsignedInteger('id_data_kategori')->nullable();

            $table->unsignedInteger('id_data_klasifikasi');
            $table->unsignedInteger('id_data_sub_klasifikasi')->nullable();


			$table->string('nama_file')->nullable();
            $table->string('ext')->nullable();
            $table->string('url_file')->nullable();
            $table->string('tags')->nullable();
            $table->string('keterangan')->nullable();
            

            $table->integer('hits')->default(0);
            $table->integer('download')->default(0);
            $table->integer('tahun')->default(2022);
            $table->string('tempat')->nullable();
            $table->string('penanggung_jawab')->nullable();
            

            $table->enum('akses', ['public', 'private', 'user'])->default('public');
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->enum('bentuk', ['cetak', 'online', 'rekam'])->default('online');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_data_file');
    }
}
