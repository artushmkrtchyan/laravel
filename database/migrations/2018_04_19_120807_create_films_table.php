<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->longText('description')->nullable();
            $table->integer('year')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('vidio_embed')->nullable();
            $table->bigInteger('author_id')->nullable();
            $table->string('status', 20)->default('no-publish');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('films');
    }
}
