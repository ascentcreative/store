<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Traits\HasMetadata;
use AscentCreative\CMS\Traits\HasSlug;

use AscentCreative\Checkout\Contracts\Sellable;
use AscentCreative\Checkout\Traits\Shippable;
use AscentCreative\CMS\Traits\Autocompletable;
use AscentCreative\Checkout\Traits\Sellable as SellableTrait;

use AscentCreative\Store\Traits\Stockable;

use AscentCreative\Images\Traits\HasGalleries;
use AscentCreative\Store\Traits\HasCategories;

class Product extends Model implements Sellable
{
    use HasFactory, HasMetadata, HasSlug, Shippable, Stockable, SellableTrait, Autocompletable, HasGalleries, HasCategories;

    public $table = 'store_products';

    public $fillable = ['id', 'title', 'description', 'short_description', 'sku', 'weight', 'price', 'is_physical', 'is_download', 'file_id'];

    public $autocomplete_search = ['title'];

    public $gallery_fields = ['images', 'extra'];


    public function getUrlAttribute() {
        return route('store.product.show', ['product' => $this]);
    }

    protected function priceString(): Attribute {
        return Attribute::make(
            get: fn ($value) => number_format($this->price, 2),
        );
    }

    protected function getPPStringAttribute() {
        if ($this->is_physical) {
            return '+P&P';
        }
        return '';
    }


    public function scopeSortByTitle($q, $dir) {
        return $q->orderBy('title', $dir);
    }

    public function scopeSortByPrice($q, $dir) {
        return $q->orderBy('price', $dir);
    }

 


    /** Eloquent Relationships */
   


    // public function images() {
    //     return $this->morphMany(\AscentCreative\CMS\Models\Image::class, 'imageable');
    // }

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
