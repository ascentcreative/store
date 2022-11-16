<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CorrectCategoryLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // the products

     
        Schema::table('store_product_categories', function(Blueprint $table) {
          
            $table->renameColumn('attribute_id', 'category_id');
            
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
        Schema::table('store_product_categories', function(Blueprint $table) {
          
            $table->renameColumn('category_id', 'attribute_id');
            
        });
       
    
    }
}
