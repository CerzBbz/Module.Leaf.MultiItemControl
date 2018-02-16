<?php

namespace StockIntel\Shared\Controls;

use Rhubarb\Leaf\Leaves\Controls\Control;

class MultipleItemControl extends Control
{
    /** @var MultipleItemControlModel */
    protected $model;

    protected $columns;

    public function __construct($name = null, $initialiseModelBeforeView = null, array $columns = [])
    {
        $this->columns = $columns;
        parent::__construct($name, $initialiseModelBeforeView);
    }

    protected function getViewClass()
    {
        return MultipleItemControlView::class;
    }

    protected function createModel()
    {
        return new MultipleItemControlModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();
        $this->model->columns = $this->columns;
    }
}