<?php

namespace AscentCreative\Store;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Router;


use AscentCreative\Checkout\Facades\Sellables;


class StoreServiceProvider extends ServiceProvider
{
  public function register()
  {
    //

    // Register the helpers php file which includes convenience functions:
    
    $this->mergeConfigFrom(
        __DIR__.'/../config/store.php', 'store'
    );
    
    $this->registerModelAliases();

    Gate::policy(app('product')::class, \AscentCreative\Store\Policies\ProductPolicy::class);

  }


  public function registerModelAliases() {

        // For each model:
        // 1) Set up an alias for the Facade (allows Page::method() calls)
        $aliases['Product'] = \AscentCreative\Store\Facades\ProductFacade::class;

        // 2) resolve the key in getFacadeAccessor()
        $this->app->bind('product',function(){
            $cls = config('store.models.product');
            return new $cls();
        });

        // 3) Use Interface/Implementation binding to allow TypeHinting to resolve the right class.
        $this->app->bind(\AscentCreative\Store\Models\Product::class, $cls = config('store.models.product'));

        $loader = \Illuminate\Foundation\AliasLoader::getInstance($aliases);

  }

  public function boot()
  {

    // create a non-public disk for storing product payloads
    config(['filesystems.disks.store' => [
        'driver' => 'local',
        'root' => storage_path('store'),
    ]]);


    $this->loadViewsFrom(__DIR__.'/../resources/views', 'store');

    $this->loadRoutesFrom(__DIR__.'/../routes/store-web.php');

    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    $this->bootComponents();

    $this->bootPublishes();

    $this->bootCommands();



    // Sellables::register(\AscentCreative\Store\Models\Product::class);
    Sellables::register(config('store.models.product'));
    
  }

  

    // register the components
    public function bootComponents() {


    }


    public function bootPublishes() {

        $this->publishes([
        __DIR__.'/../assets' => public_path('vendor/ascent/products'),

        ], 'public');

        $this->publishes([
        __DIR__.'/config/products.php' => config_path('products.php'),
        ]);

    }


    public function bootCommands() {
        $this->commands([
            \AscentCreative\Store\Commands\ZendImport::class,
        ]);
    }



}