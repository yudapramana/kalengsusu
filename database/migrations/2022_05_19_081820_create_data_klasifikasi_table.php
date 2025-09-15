<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKlasifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_data_klasifikasi', function (Blueprint $table) {
            $table->increments('id_data_klasifikasi');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name')->nullable();
			$table->string('slug')->nullable();

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
        Schema::dropIfExists('ref_data_klasifikasi');
    }
}
