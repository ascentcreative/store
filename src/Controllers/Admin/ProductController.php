<?php

namespace AscentCreative\Store\Controllers\Admin;

use AscentCreative\CMS\Controllers\AdminBaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

use AscentCreative\CMS\Admin\UI\Index\Column;

class ProductController extends AdminBaseController
{

    // static $modelClass = 'AscentCreative\Store\Models\Product';
    static $modelClass = 'Product';
    static $bladePath = 'store::admin.products';
    static $formClass = 'ProductForm'; //'AscentCreative\Store\Forms\Admin\Product';

    public $ignoreScopes = ['published', 'publish_sort'];

    public $indexSearchFields = ['title'];

    public function addstock() {

        $form = new \AscentCreative\Store\Forms\Admin\Modal\AddStock();
        $form->validate(request()->all());

        // $stock = new \AscentCreative\Store\Models\Stock();
        // $stock->fill(request()->all());
        $stock = \AscentCreative\Store\Models\Stock::create(request()->all());

    }


    public function getColumns() : array {

        return [

            Column::make('Title')
                ->valueProperty('title')
                ->isLink(true),

            Column::make('Stock')
                ->value(function($item) { 
                    return $item->grossStock ?? '-';
                })
                ->align('center')
                ->width('1%'),
                

            Column::make('Available')
            ->value(function($item) { 
                return $item->availableStock ?? '-';
                })
                ->align('center')
                ->width('1%'),

        ];

    }

    public function buildActionMenuColumn() {
        return Column::make()
                ->titleBlade('cms::admin.ui.index.clearfilters')
                ->valueBlade('store::admin.products.actionmenu')
                ->align('right')
                ->width('1%');
    }

}