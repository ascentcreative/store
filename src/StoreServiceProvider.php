<?php

namespace AscentCreative\Store;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;

class StoreServiceProvider extends ServiceProvider
{
  public function register()
  {
    //

    // Register the helpers php file which includes convenience functions:
    
    $this->mergeConfigFrom(
        __DIR__.'/../config/store.php', 'store'
    );

  }

  public function boot()
  {

    $this->loadViewsFrom(__DIR__.'/../resources/views', 'store');

    $this->loadRoutesFrom(__DIR__.'/../routes/store-web.php');

    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    $this->bootComponents();

    $this->bootPublishes();

    $this->bootCommands();

    
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