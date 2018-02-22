<?php

namespace Webakula\Admin\FormElements\DynamicTable\Traits;

trait PrepareAttributes
{
    public static function prepareAttributes(&$table)
    {
        if (isset($table['attributes']) && is_array($table['attributes'])) {
            $attrs = '';
            foreach ($table['attributes'] as $key => $value) {
                $attrs .= ' ' . $key . '="' . $value . '" ';
            }
            $table['attributes'] = $attrs;
        }
        if (isset($table['data']) && is_array($table['data'])) {
            $attrs = '';
            foreach ($table['data'] as $key => $value) {
                $attrs .= ' data-' . $key . '="' . $value . '" ';
            }
            $table['data'] = $attrs;
        }
        if (isset($table['style']) && is_array($table['style'])) {
            $attrs = [];
            foreach ($table['style'] as $key => $value) {
                $attrs [] = $key . ':' . $value . ';';
            }
            $table['style'] = ' style="' . implode('', $attrs) . '" ';
        }
        return $table;
    }
}