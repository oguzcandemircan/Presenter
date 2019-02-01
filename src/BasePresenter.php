<?php

namespace OguzcanDemircan\Presenter;

use Illuminate\Support\Str;

trait BasePresenter 
{   
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getModelPluralName()
    {
        return str::lower(str_plural(class_basename($this->model)));
    }
}