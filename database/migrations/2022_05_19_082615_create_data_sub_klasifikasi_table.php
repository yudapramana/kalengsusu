<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSubKlasifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_data_sub_klasifikasi', function (Blueprint $table) {
            $table->increments('id_data_sub_klasifikasi');
			$table->timestamps();
			$table->softDeletes();

            $table->unsignedInteger('id_data_klasifikasi');
			$table->string('name')->nullable();
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
