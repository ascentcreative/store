<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductFileId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // the products
        Schema::table('store_products', function(Blueprint $table) {
            
            $table->tinyInteger('is_physical')->index()->after('short_description');
            $table->tinyInteger('is_download')->index()->after('price');
            $table->integer('file_id')->nullable()->index()->after('is_download');
            
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
        Schema::table('store_products', function(Blueprint $table) {
            
            $table->dropColumn('is_physical');
            $table->dropColumn('is_download');
            $table->dropColumn('file_id');
            
        });
       
    
    }
}
