<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // the products
        Schema::create('store_products', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->string('sku', 12)->index();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();

            $table->integer('weight')->index()->nullable();

            $table->float('price')->index();

            $table->timestamps();
        });

        // attributes for products
        Schema::create('store_attributes', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // the options the attributes may have
        Schema::create('store_attribute_options', function(Blueprint $table) {
            $table->id();
            $table->integer('attribute_id')->index();
            $table->integer('product_id')->nullable()->index();
            $table->integer('sort')->index()->default(0);
            $table->string('display')->index();
            $table->string('value')->index();
            $table->float('price')->nullable()->index();
            $table->timestamps();
        });

        // 
        Schema::create('store_product_attributes', function(Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index();
            $table->integer('attribute_id')->index();
            $table->integer('sort')->index()->default(0);
            $table->timestamps();
        });

        

        Schema::create('store_categories', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('store_product_categories', function(Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index();
            $table->integer('attribute_id')->index();
            $table->timestamps();
        });

        Schema::create('store_types', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('store_product_types', function(Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index();
            $table->integer('attribute_id')->index();
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
        //
        Schema::drop('store_products');
        Schema::drop('store_attributes');
        Schema::drop('store_attribute_options');
        Schema::drop('store_product_attributes');

        Schema::drop('store_categories');
        Schema::drop('store_product_categories');

        Schema::drop('store_types');
        Schema::drop('store_product_types');
    
    }
}
