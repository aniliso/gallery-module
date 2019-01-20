<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery__albums', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->integer('sorting')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->integer('counter')->unsigned();
            $table->json('settings')->nullable();

            // Meta Fields
            $table->enum('meta_robot_no_index', ['index', 'noindex'])->default('index');
            $table->enum('meta_robot_no_follow', ['follow', 'nofollow'])->default('follow');

            // Sitemap Fields
            $table->boolean('sitemap_include')->default(1);
            $table->enum('sitemap_priority', ['0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0'])->default('0.9');
            $table->enum('sitemap_frequency', ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])->default('weekly');

            // Category Relation
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('gallery__categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('gallery__albums');
        Schema::enableForeignKeyConstraints();
    }
}
