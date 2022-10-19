<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Traits\HasMetadata;
use AscentCreative\CMS\Traits\HasSlug;

use AscentCreative\Checkout\Contracts\Sellable;
use AscentCreative\Checkout\Traits\Shippable;
use AscentCreative\CMS\Traits\Autocompletable;
use AscentCreative\Checkout\Traits\Sellable as SellableTrait;

use AscentCreative\Store\Traits\Stockable;

class Product extends Model implements Sellable
{
    use HasFactory, HasMetadata, HasSlug, Shippable, Stockable, SellableTrait, Autocompletable;

    public $table = 'store_products';

    public $fillable = ['title', 'description', 'short_description', 'sku', 'weight', 'price', 'is_physical', 'id_download', 'file_id'];

    public $autocomplete_search = ['title'];


    public function getUrlAttribute() {
        return route('store.product.show', ['product' => $this]);
    }

    /** Eloquent Relationships */
    public function images() {
        return $this->morphMany(\AscentCreative\CMS\Models\Image::class, 'imageable');
    }

    /** Sellable */
    public function getItemPrice() {
        return $this->price;
    }

    public function getItemName() {
        return $this->title;
    }

    public function isPhysical() {
        return $this->is_physical;
    }

    public function getItemWeightAttribute() {
        return $this->weight;
    }

    public function isDownload() {
        return $this->is_download;
    }

    public function getDownloadUrl() {
        return null;
    }


    public function getSellableLabelAttribute() {
        return $this->title;
    }

}
