<?php

namespace AscentCreative\Store\Facades;

use Illuminate\Support\Facades\Facade;

class ProductFormFacade extends Facade 
{
    protected static function getFacadeAccessor()
    {
        return 'product_form';
    }
}