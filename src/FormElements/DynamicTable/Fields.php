<?php
/**
 * Created by PhpStorm.
 * User: php-dev
 * Date: 21.02.18
 * Time: 17:41
 */

namespace App\Classes\DynamicTable;

use App\Classes\DynamicTable\Traits\PrepareAttributes;

class Fields
{
    use PrepareAttributes;
    const FIELD_TEXT = 'text';
    const FIELD_EMAIL = 'email';
    const FIELD_NUMBER = 'number';
    const FIELD_CHECKBOX = 'checkbox';
    const FIELD_SELECT = 'select';
    const FIELD_PASSWORD = 'password';
    const FIELD_TEL = 'tel';
    private static $inputFields = [];
    const SELECT_DEFAULT_KEY = 'id';
    const SELECT_DEFAULT_VALUE = 'title';

    public static function render($field, $value = '', $forceReadonly = true, $element = null)
    {
        if (is_null($element)) {
            throw new \Exception('No element provided');
        }
        $fieldName = array_keys($field)[0];
        $field = $field[$fieldName];
        if (!count(self::$inputFields)) {
            self::$inputFields = array_values((new \ReflectionClass(__CLASS__))->getConstants());
        }
        if (in_array($field['type'], self::$inputFields)) {
            return self::renderInput($field, $forceReadonly, $fieldName, $element, $value);
        }
        throw new \Exception('Only input fields and selects are supported now');
    }

    private static function renderInput($field, $forceDisabled = false, $name = null, $element = null, $value = '')
    {
        if ($forceDisabled) {
            $field['options']['attributes']['disabled'] = 'disabled';
        }
        self::prepareAttributes($field['options']);
        $renderedInput = '';
        switch ($field['type']) {
            case self::FIELD_CHECKBOX:
                $input = '<input name="' . $element . '[][' . $name . ']" type="' . $field['type'] . '" ' . (@$field['options']['style'] ?? '') . ' ' . (@$field['options']['data'] ?? '') . ' ' . (@$field['options']['attributes'] ?? '');
                $input .= ' value="1" ';
                if (@$value == 1) {
                    $input .= ' checked="checked" ';
                }
                $input .= ' />';
                $renderedInput = '<input ' . ($forceDisabled ? 'disabled="disabled"' : '') . ' type="hidden" value="0" name="' . $element . '[][' . $name . ']">' . $input;
                break;
            case self::FIELD_SELECT:
                $renderedInput = self::renderSelect($field, $forceDisabled, $name, $element, $value);
                break;
            default:
                $input = '<input name="' . $element . '[][' . $name . ']" type="' . $field['type'] . '" ' . (@$field['options']['style'] ?? '') . ' ' . (@$field['options']['data'] ?? '') . ' ' . (@$field['options']['attributes'] ?? '');
                $input .= 'value="' . (@$value) . '" ';
                $input .= ' />';
                $renderedInput = $input;
                break;
        }

        return $renderedInput;
    }

    private static function renderSelect($field, $forceDisabled = false, $name = null, $element = null, $value = '')
    {

        if (!is_string($field['values']) && !is_array($field['values'])) {
            throw new \Exception('Please specify an arraay of options or a model class');
        }
        if (is_array($field['values'])) {
            $values = $field['values'];
        } else {
            $class = $field['values'];
            if (!class_exists($class)) {
                throw new \Exception(printf('Model class [%s] does not exists', $class));
            }
            $model = \App::make($class);
            if (isset($field['scopes']) && count($field['scopes']) > 0) {
                foreach ($field['scopes'] as $scope) {
                    $model->$scope();
                }
            }
            $keyField = $field['key'] ?? self::SELECT_DEFAULT_KEY;
            $valueField = $field['value'] ?? self::SELECT_DEFAULT_VALUE;
            $values = $model->pluck($valueField, $keyField)->toArray();
        }
        $input = '<select name="' . $element . '[][' . $name . ']" type="' . $field['type'] . '" ' . (@$field['options']['style'] ?? '') . ' ' . (@$field['options']['data'] ?? '') . ' ' . (@$field['options']['attributes'] ?? '') . ' >';
        if (!isset($field['default_option']) || ($field['default_option'] !== false)) {
            array_unshift($values, 'Выберите');
        }
        foreach ($values as $val => $title) {
            $input .= '<option ' . ($val == $value ? 'selected="selected" ' : '') . ' value="' . $val . '">' . $title . '</option>';
        }
        $input .= '</select>';
        return $input;
    }

}