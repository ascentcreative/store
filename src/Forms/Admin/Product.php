<?php
namespace AscentCreative\Store\Forms\Admin;

use AscentCreative\CMS\Forms\Admin\BaseForm;
use AscentCreative\Forms\Fields\Checkbox;
use AscentCreative\Forms\Fields\Input;
use AscentCreative\StackEditor\StackEditor;
use AscentCreative\Forms\Fields\Textarea;
use AscentCreative\Forms\Fields\HasMany;
use AscentCreative\Forms\Fields\ForeignKeySelect;
use AscentCreative\Forms\Fields\PivotList;
use AscentCreative\Files\Fields\FileUpload;

use AscentCreative\Images\Forms\Fields\GalleryUpload;
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


                    \AscentCreative\CMS\Forms\Subform\Publishable::make(''),

                    // ideally, this would be a type ahead kinda field
                    // i.e. a pivot list, you muppet... d'oh
                    // ForeignKeySelect::make('categories','Categories', 'checkbox')
                    //                         ->query(\AscentCreative\Store\Models\Category::query())
                    //                         ->labelField('name')
                    //                        ->sortField('name'),

                    // PivotList::make('categories','Categories')
                    //                         ->query(\AscentCreative\Store\Models\Category::query())
                    //                         ->labelField('name')
                    //                        ->sortField('name'),

                   
                ]),


            Tabs::make('tabs_options')
                ->children([

                    Tab::make('details', "Details")
                        ->children([

                            StackEditor::make('description')

                        ]),

                    Tab::make('tab_images', "Images")
                        ->children([

                            // HasMany::make('images', "Images")
                            //     ->relationship('images')->package('store')
                            //     ->setDescription("The first image will be used as the main image in list views."),

                            // FileUpload::make('images', 'Images')
                            //     ->multiple(true)
                            //     ->disk('store')->path('payloads'),

                            GalleryUpload::make('images', 'Product Images:')
                                ->disk('images')->path('gallery-images'),
                            
                        ]),

                    Tab::make('tab_cats', "Categories")
                        ->children([
                            PivotList::make('categories', 'Categories')
                            // ->description('The contacts which this login can access in the Writers Portal')
                             ->labelField('name')
                             ->optionRoute(route('store-category.autocomplete'))
                             ->optionModel(\AscentCreative\Store\Models\Category::class)
                             ->sortField('name'),
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


                            // FileUpload::make('file_id', 'File')
                            //     ->disk('store')->path('payloads'),

                            FileUpload::make('payload', 'File')
                                ->disk('store')->path('payloads')
                                ->chunkSize('50M'),
                                
                        
                        ])


                ]),

        ]);

      

    }

}
