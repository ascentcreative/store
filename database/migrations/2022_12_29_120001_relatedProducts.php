<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('store_products_related', function(Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index();
            $table->integer("related_id")->index();
            $table->integer('sort')->default(0)->index();
        });

    }



     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::drop('store_products_related');

    }

};
