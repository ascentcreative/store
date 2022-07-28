<?php
namespace AscentCreative\Store\Forms\Admin;

use AscentCreative\CMS\Forms\Admin\BaseForm;
use AscentCreative\Forms\Fields\Checkbox;
use AscentCreative\Forms\Fields\Input;
use AscentCreative\StackEditor\StackEditor;
use AscentCreative\Forms\Fields\Textarea;
use AscentCreative\Forms\Fields\ForeignKeySelect;
use AscentCreative\Forms\Fields\FileUpload;
use AscentCreative\CMS\Forms\Structure\Screenblock;
use AscentCreative\Forms\Structure\Tabs;
use AscentCreative\Forms\Structure\Tab;

class Product extends BaseForm {

    public function __construct() {

        parent::__construct();

        $this->children([

            Screenblock::make('details')
                ->children([
                    Input::make('title', 'Title')
                            ->required(true),

                    Input::make('sku', 'SKU')
                        ->required(true),

                    Input::make('price', "Price")
                        ->preelement('£')
                        ->required(true),

                    Textarea::make("short_descrition", "Summary")
                        ->rows(3),


                ]),


            Tabs::make('tabs_options')
                ->children([

                    Tab::make('details', "Details")
                        ->children([

                            
                            StackEditor::make('description')

                        ]),

                    Tab::make('physical', "Physical")
                        ->children([

                            Checkbox::make("is_physical", "Physical")
                                ->uncheckedValue(0),

                            Input::make('weight', 'Weight')
                                ->postelement('grams'),
                        
                        ]),

                    Tab::make('download', "Download")
                        ->children([

                            Checkbox::make("is_download", "Download")
                                ->uncheckedValue(0),


                            FileUpload::make('file_id', 'File')
                                ->disk('store')->path('payloads'),
                                
                        
                        ])


                ]),

        ]);

      

    }

}
