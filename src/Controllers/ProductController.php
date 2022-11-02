<?php

namespace AscentCreative\Store\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use AscentCreative\CMS\Filters\FilterManager;

use AscentCreative\Store\Models\Product;

class ProductController extends Controller
{

    public $pageSize = 24;

    public function show(Product $product) {
        // dd($product); 
        headtitle()->add($product->title);

        return view(config('store.product_show_blade', 'store::product.show'))->with('model', $product);
    }


    public function index() {

        // $fm = new FilterManager();
        
        // $query = $fm->registerFilter('themes', 'byTheme')
        //     ->registerFilter('purposes', 'byPurpose')
        //     ->setFilterWrapper('cfilter')
        //     ->apply(Resource::query());
            
        // // should pagination be part of the filter manager??
        // return view('resources.index')->with('models', $query->get());

        
    }

    public function loadmore() {

      

    }




}
