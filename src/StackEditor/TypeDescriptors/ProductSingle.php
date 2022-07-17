<?php

namespace AscentCreative\Store\StackEditor\TypeDescriptors;

use AscentCreative\StackEditor\TypeDescriptors\AbstractDescriptor; 

class ProductSingle extends AbstractDescriptor { 

    public static $name = 'Single Product';

    public static $bladePath = 'product-single';

    public static $description = "A card for a specific product";

    public static $category = "Store";

}