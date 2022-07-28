<?php
namespace AscentCreative\Store\Forms\Admin\Modal;

use AscentCreative\CMS\Forms\Admin\BaseForm;
use AscentCreative\Forms\Fields\Input;
use AscentCreative\Forms\Fields\ForeignKeySelect;
use AscentCreative\CMS\Forms\Structure\Screenblock;

class AddStock extends BaseForm {

    public function __construct() {

        parent::__construct();

        $this->attribute('data-onsuccess', 'refresh');

        $this->children([
            
            ForeignKeySelect::make('stock_location_id', "Location")
                ->query(\AscentCreative\Store\Models\Stock\Location::query())
                ->labelField('name')
                ->sortField('id')
                ->required(true),

            Input::make('quantity', 'Quantity')
                    ->description('Positive for inbound stock / Negative for outbound')
                    ->required(true),

            Input::make('value', 'Value')
                    ->description('Positive for income / Negative for expenditure')
                    ->required(true),

            Input::make('description', "Description"),

            Input::make('stockable_type', '', 'hidden')->wrapper('none'),
            Input::make('stockable_id', '', 'hidden')->wrapper('none')

        ]);

      

    }

}
