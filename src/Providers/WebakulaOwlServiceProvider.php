<?php

namespace Webakula\Admin\Providers;

use AdminFormElement;
use AdminColumn;
use Illuminate\Support\ServiceProvider;
use Webakula\Admin\FormElements\googleMap;
use Webakula\Admin\FormElements\DynamicTable;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;

class WebakulaOwlServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'webakula');

        $this->publishes([
            __DIR__.'/../../assets' => public_path('vendor/webakula'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../config/webakula_owl_extend.php' => config_path('webakula_owl_extend.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../../config/wa_soa_table.php' => config_path('wa_soa_table.php'),
        ], 'config');
    }
    public function register() {
        AdminFormElement::add('googleMap', googleMap::class);
        AdminFormElement::add('dynamicTable', DynamicTable::class);
    }
}