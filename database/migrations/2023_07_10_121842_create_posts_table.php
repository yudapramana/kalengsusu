<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('cover')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->longText('desc');
            $table->string('keywords');
            $table->text('meta_desc');
            $table->unsignedInteger('id_kabkota')->default(0);
            $table->bigInteger('reads')->unsigned()->default(0)->index();
            $table->timestamps();
            $table->softDeletes();

            $table->tinyInteger('is_slider')->unsigned()->default(0);
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->tinyInteger('is_recommended')->unsigned()->default(0);
            $table->tinyInteger('is_breaking')->unsigned()->default(0);
            $table->tinyInteger('published')->unsigned()->default(0);
            $table->enum('status', ['published', 'draft', 'archived'])->default('published');
            $table->unsignedInteger('old_id')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
