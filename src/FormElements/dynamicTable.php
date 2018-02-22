<?php

namespace Webakula\Admin\FormElements;

use KodiCMS\Assets\Facades\Meta;
use SleepingOwl\Admin\Form\Element\NamedFormElement;
use Webakula\Admin\FormElements\DynamicTable\Traits\PrepareAttributes;
use Webakula\Admin\FormElements\DynamicTable\Traits\ExtendTable;

class DynamicTable extends NamedFormElement
{

    use PrepareAttributes, ExtendTable;

    public function initialize()
    {
        Meta::addJs('admin-custom-js-draguls', asset('vendor/webakula/js/libs/dragula.js'));
        Meta::addJs('admin-custom-js-dynamicTable-init', asset('vendor/webakula/js/dynamic-table/dynamic-table.js'));
    }

    public function render()
    {
        $table = \Config::get('wa_soa_table.' . $this->name);
        if (is_null($table)) {
            throw new \BadMethodCallException('Element [' . $this->name . '] config not found');
        }

        //dd($table);
        if (isset($table['extends'])) {
            $extend = \Config::get('wa_soa_table.' . $table['extends']);
            if (!is_null($extend)) {
                self::extendTable($table, $extend);
            }
        }
        self::prepareAttributes($table);
        return view('webakula::form-element.dynamic-table', $this->toArray() + ['table' => (object)$table])->render();
    }

}
