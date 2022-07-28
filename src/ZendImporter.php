<?php

namespace AscentCreative\Store;

use Illuminate\Support\Facades\DB;

use AscentCreative\Store\Models\Product;

class ZendImporter {

    static function import() {

        Product::truncate();

        $res = DB::connection('zend')->select('select * from store_product');        

        foreach($res as $prod) {

            $product = Product::create([

                'title' => $prod->name,
                'sku' => $prod->sku,
                'description' => $prod->description,
                'short_description' => $prod->summary,
                'price' => $prod->priceGBP,

            ]);

        }

    }


}