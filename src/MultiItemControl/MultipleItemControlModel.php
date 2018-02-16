<?php

namespace StockIntel\Shared\Controls;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Controls\ControlModel;

class MultipleItemControlModel extends ControlModel
{
    public $columns;

    /** @var  Event */
    public $addItemEvent;

    /** @var  Event */
    public $deleteRowEvent;

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();
        $properties[] = 'columns';
        $properties[] = 'value';
        return $properties;
    }
}