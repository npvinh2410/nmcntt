<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('positions')->unique();
            $table->timestamps();
        });

        Schema::create('widget_translate', function (Blueprint $table){

            $table->increments('id');
            $table->integer('widget_id')->references('id')->on('widgets');
            $table->text('content');
            $table->string('lang_code');

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
        Schema::dropIfExists('widget_translate');
        Schema::dropIfExists('widgets');
    }
}
