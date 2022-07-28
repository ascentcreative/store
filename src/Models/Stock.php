<?php

namespace AscentCreative\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{
    use HasFactory;

    public $table = 'store_stock';

    public $fillable = ['stockable_type', 'stockable_id', 'stock_location_id', 'quantity', 'value', 'description'];



}
