<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // the products
        Schema::create('store_stock', function(Blueprint $table) {
            $table->id();
            $table->string('stockable_type');
            $table->integer('stockable_id')->index();
            $table->integer('stock_location_id')->index();
            $table->string('description')->nullable();
            $table->integer('quantity')->index();
            $table->float('value')->index();
            $table->timestamps();
        });

     
        Schema::create('store_stock_locations', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();

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
        Schema::drop('store_stock');
        Schema::drop('store_stock_locations');
       
    
    }
}
