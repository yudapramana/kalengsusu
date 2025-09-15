<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_data_kategori', function (Blueprint $table) {
            $table->increments('id_data_kategori');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name')->nullable();
            $table->boolean('is_verified')->default(false);
			$table->string('created_by')->default('');
            $table->string('updated_by')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_data_kategori');
    }
}
