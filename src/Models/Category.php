<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Traits\HasSlug;
use AscentCreative\CMS\Traits\Autocompletable;


class Category extends Model
{
    use HasFactory, HasSlug, Autocompletable;

    public $table = 'store_categories';
    public $autocomplete_search = ['name']; 
    
    public $fillable = ['name', 'slug'];

    public function products() {
        return $this->belongsToMany(app('product'), ProductCategory::class);
    }

    public function scopeHasProducts($q) {
        return $this->whereHas('products');
    }

}
