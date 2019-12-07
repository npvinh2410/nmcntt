<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ///catalog

        Schema::create('catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->references('id')->on('catalog');

            $table->timestamps();
        });

        Schema::create('catalogTrans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->string('lang_code');
            $table->integer('catalog_id')->references('id')->on('catalog');

            $table->timestamps();
        });

        //tag

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('tagTrans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->string('lang_code');
            $table->integer('tag_id')->references('id')->on('tags');

            $table->timestamps();
        });

        //taxes

        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('value');

            $table->timestamps();
        });

        //attribute

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');

            $table->timestamps();
        });

        Schema::create('attributesTrans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('lang_code');
            $table->integer('attributes_id')->references('id')->on('attributes');

            $table->timestamps();
        });

        Schema::create('attributeValues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->integer('attributes_id')->references('id')->on('attributes');

            $table->timestamps();
        });

        //products

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->nullable();
            $table->integer('stock')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('template');
            $table->integer('main_cat')->references('id')->on('catalog');
            $table->integer('tax_id')->references('id')->on('tax');
            $table->integer('related')->references('id')->on('products')->nullable();

            $table->timestamps();
        });

        Schema::create('productTrans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('price')->nullable();
            $table->string('price_on_sale')->nullable();
            $table->string('discount')->nullable();
            $table->boolean('status')->default(false);
            $table->string('lang_code');
            $table->integer('product_id')->references('id')->on('products');

            $table->timestamps();
        });



        Schema::create('productImages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img');
            $table->string('product_id')->references('id')->on('products');
            $table->integer('priority');

            $table->timestamps();
        });

        Schema::create('productCatalog', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('catalog_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('catalog_id')->references('id')->on('catalog')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['product_id', 'catalog_id']);
        });

        Schema::create('productTag', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['product_id', 'tag_id']);
        });

        Schema::create('productAttribute', function (Blueprint $table) {
            $table->integer('productTrans_id')->references('id')->on('productTrans');
            $table->integer('attribute_id')->references('id')->on('attributes');
            $table->text('value')->nullable();

            $table->primary(['attribute_id', 'productTrans_id']);

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
        Schema::dropIfExists('productAttribute');
        Schema::dropIfExists('productCatalog');
        Schema::dropIfExists('productTag');
        Schema::dropIfExists('productImages');
        Schema::dropIfExists('productTrans');
        Schema::dropIfExists('products');
        Schema::dropIfExists('attributeValues');
        Schema::dropIfExists('attributesTrans');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('taxes');
        Schema::dropIfExists('catalogTrans');
        Schema::dropIfExists('catalog');
        Schema::dropIfExists('tagTrans');
        Schema::dropIfExists('tags');
    }
}
