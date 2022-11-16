<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Traits\HasSlug;


class Category extends Model
{
    use HasFactory, HasSlug;

    public $table = 'store_categories';

    public $fillable = ['name', 'slug'];

    public function products() {
        return $this->belongsToMany(Product::class, ProductCategory::class);
    }

    public function scopeHasProducts($q) {
        return $this->whereHas('products');
    }

}
