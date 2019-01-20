<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryAlbumTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery__album_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your translatable fields
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();

            // Meta Fields
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_type')->nullable();

            $table->integer('album_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['album_id', 'locale']);
            $table->foreign('album_id')->references('id')->on('gallery__albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery__album_translations', function (Blueprint $table) {
            $table->dropForeign(['album_id']);
        });
        Schema::dropIfExists('gallery__album_translations');
    }
}
