<?php
namespace AscentCreative\Store\Forms\Admin;

use AscentCreative\CMS\Forms\Admin\BaseForm;
use AscentCreative\Forms\Fields\Input;
use AscentCreative\Forms\Fields\ForeignKeySelect;
use AscentCreative\CMS\Forms\Structure\Screenblock;

class Product extends BaseForm {

    public function __construct() {

        parent::__construct();

        $this->children([

            Screenblock::make('details')
                ->children([
                    Input::make('title', 'Title')
                            ->required(true),

                ]),

        ]);

      

    }

}
