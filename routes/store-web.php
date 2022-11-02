<?php

use AscentCreative\Store\Models\Product;

Route::namespace('AscentCreative\Store\Controllers')->middleware(['web'])->group(function() {   

    Route::prefix(config('store.store_path'))->group(function() {

        if(config('store.use_default_landing_page')) {
            Route::get('/', function() {
                echo 'cat home';
            });
        }

        Route::basket('product', config('store.models.product')); //AscentCreative\Store\Models\Product::class);

        Route::resource('product', ProductController::class, ['as'=>'store'])
                ->parameters([
                    'product' => 'product:slug'
                ]);

    });


    Route::prefix('/admin/store')->middleware(['auth', 'can:administer'])->group(function() {

            Route::get('/products/{product}/addstock', function(Product $product) {
                return view('store::admin.products.modal.addstock', ['product'=>$product]);
            })->name('admin.store.products.addstock');

            Route::post('/products/{product}/addstock', [AscentCreative\Store\Controllers\Admin\ProductController::class, 'addstock'])
                            ->name('admin.store.products.addstock');

            Route::get('/products/{product}/delete', [AscentCreative\Store\Controllers\Admin\ProductController::class, 'delete']);
            
            Route::resource('/products', \Admin\ProductController::class, ['as'=>'admin.store']);

            Route::resource('stock', \Admin\StockController::class, ['as'=>'admin.store']);

    });

});