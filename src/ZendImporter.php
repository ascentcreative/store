<?php

namespace AscentCreative\Store;

use Illuminate\Support\Facades\DB;

// use AscentCreative\Store\Models\Product;
use AscentCreative\Images\Models\Image;

class ZendImporter {

    static function import() {

        // dd(app('product'));

        app('product')::truncate();

        Image::where('imageable_type', config('store.models.product'))->delete();

        $res = DB::connection('zend')->select('select * from store_product');        

        foreach($res as $prod) {

            $product = app('product')::create([

                'title' => $prod->name,
                'sku' => $prod->sku,
                'description' => $prod->description,
                'short_description' => $prod->summary,
                'price' => $prod->priceGBP,
                'is_physical' => $prod->isPhysical,
                'is_download' => $prod->isDownload

            ]);

            $image = basename($prod->imageFile);

            $image = Image::create([
                'imageable_type' => app('product')::class,
                'imageable_id' => $product->id,
                'imageable_key' => 'images',
                'imageable_sort' => 0,
                'original_filename' => $image,
                'hashed_filename' => $image

            ]);



        }

    }


}