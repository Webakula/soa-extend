<?php

namespace Webakula\Admin\FormElements\DynamicTable\Traits;

trait ExtendTable
{
    /**
     * @param $table New table
     * @param $base Base table to extend from
     */
    public static function extendTable(&$table, $base)
    {
        $exclude = $table['exclude'] ?? false;
        if (true === $exclude) {
            if (!isset($base['cols'])) {
                $base['cols'] = [];
            }
            $exclude = array_keys($base['cols']);
        }
        if (is_array($exclude)) {
            $exclude = array_flip($exclude);
        }
        unset($table['extends'], $table['exclude']);
        foreach ($table as $field => $subArr) {
            if (array_key_exists($field, $base)) {
                $table[$field] = array_merge($base[$field], $table[$field]);
            }
        }
        foreach ($base as $field => $value) {
            if (!array_key_exists($field, $table)) {
                $table[$field] = $value;
            }
        }
        if (false !== $exclude) {
            $table['cols'] = array_diff_key($table['cols'], $exclude);
        }
    }
}