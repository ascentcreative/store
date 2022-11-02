<?php

namespace AscentCreative\Store\Facades;

use Illuminate\Support\Facades\Facade;

class ProductFacade extends Facade 
{
    protected static function getFacadeAccessor()
    {
        return 'product';
    }
}