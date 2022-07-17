<?php

use AscentCreative\Store\Models\Product;

Route::namespace('AscentCreative\Store\Controllers')->middleware(['web'])->group(function() {

    // Route::get('store-test/{product}', function(Product $product) {

    //     basket()->add($product, 5);

    // });

    Route::basket('product', AscentCreative\Store\Models\Product::class);




    Route::resource('product', ProductController::class, ['as'=>'store'])
            ->parameters([
                'product' => 'product:slug'
            ]);
    


    // Route::resource('/image', App\Http\Controllers\ImageController::class)->parameters([
    //     'image' => 'image:slug'
    // ]);
    // function(Product $product) {
    //     dd($product);
    // })->name('store.products.show');



});