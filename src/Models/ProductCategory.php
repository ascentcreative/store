<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

use AscentCreative\CMS\Traits\HasSlug;

class ProductCategory extends Pivot
{
    
    use HasFactory;

    public $table = 'store_product_categories';

    public $fillable = ['id', 'product_id', 'category_id'];


}
