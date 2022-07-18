<?php

use AscentCreative\Store\Models\Product;

Route::namespace('AscentCreative\Store\Controllers')->middleware(['web'])->group(function() {   

    Route::prefix(config('store.store_path'))->group(function() {

        Route::get('/', function() {
            echo 'cat home';
        });

        Route::basket('product', AscentCreative\Store\Models\Product::class);

        Route::resource('product', ProductController::class, ['as'=>'store'])
                ->parameters([
                    'product' => 'product:slug'
                ]);

    });

});