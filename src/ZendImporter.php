<?php

namespace AscentCreative\Store;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// use AscentCreative\Store\Models\Product;
use AscentCreative\Images\Models\Image;
use AscentCreative\Files\Models\File;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\File as IlluminateFile;

class ZendImporter {

    static function import() {

        // dd(app('product'));

        app('product')::truncate();

        Image::where('imageable_type', config('store.models.product'))->delete();
        File::where('attachedto_type', config('store.models.product'))->delete();
        Activity::where('log_name', 'files')->delete();

        $res = DB::connection('zend')->select('select * from store_product');      
    
        dump($res);

        $replace_from = [
            'Â ',   'â€˜',  'â€™', 'Â­-',   'â€“',  'Â£',
        ];

        $replace_to = [
            ' ',    '"',    '"',    '-',    '-',    '£',
        ];

        foreach($res as $prod) {

            $rp = \App\Models\ReleaseProduct::where('product_id', $prod->id)->first();

            $product = app('product')::updateOrCreate([
                'id' => $prod->id,
            ],[

                'title' => $prod->name,
                'sku' => $prod->sku,
                'description' => str_replace($replace_from, $replace_to, $prod->description),
                'short_description' => $prod->summary,
                'price' => $prod->priceGBP,
                'is_physical' => $prod->isPhysical,
                'is_download' => $prod->isDownload,
                'publishable' => $prod->isLive,
                'release_id' => $rp->release_id ?? null,

            ]);

            $product->disableCasts();

            $image = basename($prod->imageFile);

            $image = Image::create([
                'imageable_type' => app('product')::class,
                'imageable_id' => $product->id,
                'imageable_key' => 'images',
                'imageable_sort' => 0,
                'original_filename' => $image,
                'hashed_filename' => $image

            ]);

            // also import file payloads for downloads
            if($prod->isDownload && $prod->downloadFile) {

                $path = pathinfo($prod->downloadFile);

                // copy file to storage
                $disk = Storage::disk('store');
                if($disk->exists('/payloads/' . $path['basename'])) {
                    dump('Skipping ' . $path['basename'] . ' - File Exists');
                } else {
                    dump('Copying ' . $path['basename']);
                    $stored = $disk->putFileAs('payloads', new IlluminateFile('/users/kieran/documents/ascent/goteach/zend-root/public_html' . $prod->downloadFile), $path['basename']);
                }

                // dump($stored);

                $dest = '/payloads/' . $path['basename'];

                $file = File::create([
                    'disk'=>'store',
                    'hashed_filename' => $dest,
                    'original_filename' => $path['basename'],
                    'size' => $disk->size($dest),
                    'mime_type' => $disk->mimeType($dest),
                    'attachedto_type' => app('product')::class,
                    'attachedto_id' => $product->id,
                    'attachedto_key' => 'payload',
                ]);

                // and the associated download logs
                $res = DB::connection('zend')->select("
                    select l.id, p.id as prod_id, timestamp, ipAddress from store_orderrow_log l
                        join store_orderrow r on r.id = l.idOrderRow                    
                        join store_product p on r.sku = concat(p.sku, '-D')                    
                        where action = 'download' and idOrderRow is not null
                        and p.id = " . $product->id . "

                    UNION
                    select '', idModel, timestamp, ipAddress from  gt_downloadlog 
                        where model = 'GT_Model_Product' and idModel = " . $product->id
                );    
                foreach($res as $item) {
                    $act = activity('files')
                        ->on($file)
                        ->withProperties(['ip'=>$item->ipAddress])
                        ->event('download')
                        ->log('download');
                    $act->created_at = $item->timestamp;
                    $act->save();
                }


            }


       



        }

    }


}