<?php

namespace AscentCreative\Store\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Traits\HasSlug;

class Location extends Model
{
    use HasFactory, HasSlug;

    public $table = 'store_stock_locations';
    public $slug_source = 'name';

    public $fillable = ['name'];

}
