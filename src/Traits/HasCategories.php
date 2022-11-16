<?php

namespace AscentCreative\Store\Traits;

use AscentCreative\CMS\Traits\Extender;

use AscentCreative\CMS\Forms\Structure\Screenblock;
use AscentCreative\Forms\Fields\PivotList;
use AscentCreative\Forms\Fields\ForeignKeySelect;

use AscentCreative\Forms\Structure\Tab;
use Carbon\Carbon;

trait HasCategories {

    use Extender;

    // static function bootHasAgeGroup() {
    //     dd('herte');
    // }


    public function initializeHasCategories() {
        // dd('here');
        $this->addCapturable('categories');
    }

    public function saveCategories($data) {
        // dd($data);
        $this->categories()->sync($data ?? []);
    }

    public function deleteCategories() {
        $this->categories()->sync([]);
    }



    public function categories() {
        return $this->belongsToMany(\AscentCreative\Store\Models\Category::class, \AscentCreative\Store\Models\ProductCategory::class); //, 'product');
    }

    public function scopeByCategory($q, $category_id) {
        return $q->whereHas('categories', function($q) use ($category_id) {
            $q->whereIn('store_categories.id', $category_id);
        });
    }

  
    // public function adjustFormForAgeGroup($form) {

    //     $elm = $form->findElementContaining('tab_images');

    //     $elm->addAfter('tab_images', [
    //         Tab::make('tab_ag', 'Age Group')
    //             ->children([
    //                 ForeignKeySelect::make('agegroup','Age Group', 'checkbox')
    //                     ->query(\App\Models\AgeGroup::query())
    //                     ->sortField('id')
    //             ]),
    //     ]);

    // }

}