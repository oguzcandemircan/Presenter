<?php

namespace OguzcanDemircan\Presenter;

use Illuminate\Support\Str;

/**
 * 
 */
trait PresenterTrait
{
    public function presenter($presenter)
    {   
        return new Presenter($this, $presenter);
    }

    public function getModelName()
    {
        return class_basename($this);
    }

    public function __get($property)
    {   
        $key = array_search(str::lower($property), $this->getPresenters());
        if($key !== false) {
            $key = $this->presenters[$key];
            $model = $this->getModelName();
            $namespace = config('oguzcandemircan.presenter.namespace');
            $instance = "$namespace\\$model\\$key";
            return $this->presenter($instance);
        }
        return parent::__get($property);
    }

    public function getPresenters()
    {
        return array_map(array(Str::class, 'lower'),$this->presenters);
    }
}