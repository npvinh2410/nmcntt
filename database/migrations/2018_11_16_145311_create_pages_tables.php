<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template');
            $table->timestamps();
        });

        Schema::create('pageContent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->longText('content');

            $table->string('thumbnail')->nullable();
            $table->string('lang_code');
            $table->boolean('status')->defautl(false);
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('page_id')->references('id')->on('pages');

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
        Schema::dropIfExists('pageContent');
        Schema::dropIfExists('pages');
    }
}
