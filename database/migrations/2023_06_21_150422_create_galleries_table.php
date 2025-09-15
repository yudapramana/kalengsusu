<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id('id_gallery');
            $table->timestamps();

            $table->unsignedInteger('user_id')->default(0);

            $table->text('image_url')->nullable();
            $table->string('filter_tag', 50)->nullable();
            $table->string('alt', 50)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('url')->nullable();
            $table->enum('type', ['foto', 'video', 'ebook'])->default('foto');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
