<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->references('id')->on('categories');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('categoryContent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->unique();
            $table->string('title', 255)->unique();
            $table->text('excerpt')->nullable();

            $table->integer('cat_id')->unsigned()->references('id')->on('categories');
            $table->string('lang_code', 10);

            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template');
            $table->integer('main_cat')->references('id')->on('categories');

            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('postContent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->longText('content');

            $table->string('thumbnail')->nullable();
            $table->string('lang_code');
            $table->boolean('status')->defautl(false);
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('post_id')->references('id')->on('post');

            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->integer('post_id')->unsigned()->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['post_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_category');
        Schema::dropIfExists('postContent');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categoryContent');
        Schema::dropIfExists('categories');
    }
}
