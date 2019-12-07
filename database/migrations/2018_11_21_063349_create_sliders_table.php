<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('position');
            $table->timestamps();
        });

        Schema::create('slides', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('slider_id')->unsigned();
            $table->string('name');
            $table->string('image');
            $table->string('href')->nullable();
            $table->string('target')->nullable();
            $table->string('follow')->nullable();
            $table->integer('priority')->nullable();
            $table->timestamps();

            $table->foreign('slider_id')->references('id')->on('sliders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slides');
        Schema::dropIfExists('sliders');
    }
}
