<?php

namespace OguzcanDemircan\Presenter;

use Exception;

class Presenter 
{   

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function getInstance()
    {   
        $instance = $this->presenter;
        if (! class_exists($instance)) {
            throw new Exception("[{$this->presenter}] presenter not found !");
        }
        return new $instance($this->model);
    }

    public function __get($key)
    {
        return $this->getInstance($this->model)->$key();
    }

    public function __call($method, $params)
    {
        return $this->getInstance($this->model)->$method($params);
    }
}