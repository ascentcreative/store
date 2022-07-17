<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Traits\HasMetadata;
use AscentCreative\CMS\Traits\HasSlug;

use AscentCreative\Checkout\Contracts\Sellable;
use AscentCreative\Checkout\Traits\Shippable;

class Product extends Model implements Sellable
{
    use HasFactory, HasMetadata, HasSlug, Shippable;

    public $table = 'store_products';

    public $fillable = ['title', 'description', 'short_description', 'sku', 'weight', 'price'];



    public function getUrlAttribute() {
        return route('store.product.show', ['product' => $this]);
    }

    /** Sellable */
    public function getItemPrice() {
        return $this->price;
    }

    public function getItemName() {
        return $this->title;
    }

    public function isPhysical() {
        return true;
    }

    public function getItemWeightAttribute() {
        return $this->weight;
    }

    public function isDownload() {
        return false;
    }

    public function getDownloadUrl() {
        return null;
    }

}
