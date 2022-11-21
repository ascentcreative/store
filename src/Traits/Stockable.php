<?php
namespace AscentCreative\Store\Traits;

use AscentCreative\Store\Models\Stock;

use AscentCreative\Checkout\Models\OrderItem;

trait Stockable {

    public function stock() {
        return $this->morphMany(Stock::class, 'stockable');
    }

    public function getGrossStockAttribute() {
        $stock = $this->stock->sum('quantity');

        if ($stock == 0) {
            return null;
        }

        return $stock;

    }

    public function getAvailableStockAttribute() {

        $stock = $this->grossStock;

        if (is_null($stock)) {
            return null;
        }

        $sold = $this->ordered()->whereHas('order', function($q) {
            $q->where('confirmed', 1);
        })->sum('qty');
  
        return $stock - $sold;

    }   



    public function getStockStatusAttribute() {

        // check a stock threshold

        return 'in_stock';

    }


}