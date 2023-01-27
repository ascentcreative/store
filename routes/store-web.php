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

        Route::get('/product/{product:slug}/download', [config('store.controllers.public.product'), 'download'])
            ->name('product.download');

        Route::resource('product', config('store.controllers.public.product'), ['as'=>'store'])
                ->parameters([
                    'product' => 'product:slug'
                ]);

    });


    Route::prefix('/admin/store')->middleware(['auth', 'can:administer'])->group(function() {

            Route::get('/products/{product}/addstock', function(Product $product) {
                return view('store::admin.products.modal.addstock', ['product'=>$product]);
            })->name('admin.store.products.addstock');

            Route::post('/products/{product}/addstock', [config('store.controllers.admin.product'), 'addstock'])
                            ->name('admin.store.products.addstock');

            Route::get('/products/{product}/delete', [config('store.controllers.admin.product'), 'delete']);
            
            Route::resource('/products', config('store.controllers.admin.product'), ['as'=>'admin.store']);

            Route::resource('stock', \Admin\StockController::class, ['as'=>'admin.store']);

    });


    Route::autocomplete('store-category', \AscentCreative\Store\Models\Category::class, 'name');

});