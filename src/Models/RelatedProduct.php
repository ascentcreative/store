<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class RelatedProduct extends Pivot
{
    
    use HasFactory;

    public $table = 'store_products_related';

    public $fillable = ['id', 'product_id', 'related_id', 'sort'];


}
