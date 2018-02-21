<?php

namespace Webakula\Admin\Display;

use SleepingOwl\Admin\Display\Column\NamedColumn;

class GoogleMap extends NamedColumn
{
    /**
     * @var string
     */
    protected $view = 'webakula::display.coords';

    /**
     * @var bool
     */
    protected $orderable = false;

    /**
     * @return array
     */
    public function toArray()
    {
        return parent::toArray() + [
                'value'  => $this->getModelValue()
            ];
    }
}