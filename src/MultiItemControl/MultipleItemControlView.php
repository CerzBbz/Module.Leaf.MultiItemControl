<?php

namespace StockIntel\Shared\Controls;

use Rhubarb\Leaf\Leaves\Controls\ControlView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class MultipleItemControlView extends ControlView
{
    protected $requiresContainerDiv = true;

    /** @var  MultipleItemControlModel */
    protected $model;

    protected function printViewContent()
    {
        print "<div class='js-items-container'>";

        if ($this->model->value) {
            foreach ($this->model->value as $values) {
                print "<div>";
                foreach ($this->model->columns as $column) {
                    $item = isset($values[$column]) ? $values[$column] : '';
                    $name = "{$this->model->leafPath}[{$column}][]";
                    print "<label for='{$column}' class='c-label'>{$column}: </label>";
                    print "<input type='text' name='{$name}' value='{$item}' class='c-input'>";
                }
                print "<button class='js-delete' type='button'>x</button></div>";
            }
        }
        print "</div>";

        print "<button class='js-add' type='button'>+</button>";
    }

    protected function getViewBridgeName()
    {
        return 'MultipleItemControlViewBridge';
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__ . "/" . $this->getViewBridgeName() . ".js");
    }

    protected function parsePostedValue($value)
    {
        $data = [];
        $done = false;
        while (!$done) {
            $row = [];
            foreach ($this->model->columns as $column) {
                $columnValue = array_shift($value[$column]);
                if ($columnValue === null) {
                    $done = true;
                    break;
                } else {
                    $row[$column] = $columnValue;
                }
            }
            if (!$done) {
                $data[] = $row;
            }
        }
        return $data;
    }

}
