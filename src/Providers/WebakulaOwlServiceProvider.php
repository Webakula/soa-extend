<?php

namespace Webakula\Admin\Providers;

use AdminFormElement;
use AdminColumn;
use Illuminate\Support\ServiceProvider;
use Webakula\Admin\Display\GoogleMap;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;

class WebakulaOwlServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'webakula');

        $this->publishes([
            __DIR__.'/../../assets' => public_path('vendor/webakula'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../config/webakula_owl_extend.php' => config_path('sleeping_owl_extend.php'),
        ], 'config');
    }
    public function register() {
        AdminFormElement::add('googleMap', GoogleMap::class);
    }
}