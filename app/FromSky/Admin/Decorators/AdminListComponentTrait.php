<?php


namespace App\FromSky\Admin\Decorators;


use Illuminate\Support\Str;

/**
 * Trait AdminListComponentTrait
 * @package App\FromSky\Admin\Decorators
 */
trait AdminListComponentTrait
{

    function renderComponent($page, $label)
    {
        if(is_array($label) && isset($label['roles']) && is_array($label['roles'])){
            if(!in_array(auth_user("admin")->roles->first()->name, $label['roles'])){
                $label['editable'] = false;
            }
        }
        if (!is_array($label)){ return $page->$label;}
        if ($this->hasComponent($label['type'])) {
            return $this->initList($this->property)->makeComponent($page, $label);
        }
        return (data_get($label, 'locale')) ? $page->translate($label['locale'])->{$label['field']} : $page->{$label['field']};
    }


    function hasComponent($type): bool
    {
        $sample = new \ReflectionClass($this);
        if ($sample->hasMethod($this->resolveMethodName($type))) {
            return true;
        }
        if ($this->componentViewExist($type)) {
            return true;
        }
        if ($this->componentClassExist($type)) return true;
        return false;
    }

    /**
     * Make Zone
     * @param $page
     * @param $itemProperty
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|mixed
     */
    function makeComponent($page, $itemProperty)
    {
        if ($this->componentClassExist($itemProperty['type'])) {
            $componentClassName = $this->resolveComponentClassNamespace($itemProperty['type']);
            return (new $componentClassName($page, $itemProperty))->setPageConfig($this->property)->render();
        }
        if ($this->componentViewExist($itemProperty['type'])) {
            return (new AdminListViewComponent($page, $itemProperty))->setPageConfig($this->property)->render();
        }
        return $this->{$this->resolveMethodName($itemProperty['type'])}($page, $itemProperty);
    }


    function resolveMethodName($type): string
    {
        return 'make' . ucfirst(Str::camel($type));
    }


    function resolveComponentClassNamespace($type): string
    {
        return "App\FromSky\Admin\Decorators\AdminList" . ucfirst(Str::camel($type)) . "Component";
    }

    function componentClassExist($type): bool
    {
        return class_exists($this->resolveComponentClassNamespace($type));
    }

    function componentViewExist($type): bool
    {
        return view()->exists('admin.list.' . $type);
    }
}