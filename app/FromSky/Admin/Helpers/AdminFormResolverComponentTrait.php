<?php

namespace App\FromSky\Admin\Helpers;

use Form;
use App\FromSky\Admin\AdminFormSelect;
use App\FromSky\Admin\Decorators\AdminForm\ViewComponent;
use App\FromSky\Admin\Facades\AdminFormImageRelation;

use Illuminate\Support\Str;

/**
 * Trait AdminListComponentTrait
 * @package App\FromSky\Admin\Decorators
 */
trait AdminFormResolverComponentTrait
{

    /**
     *
     * @param $value
     * @param $key
     * @param $field_properties
     * @param $locale
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    function renderComponent($value, $key, $field_properties, $locale)
    {

        if(isset($this->property['roles']) && is_array($this->property['roles'])){
            if(!in_array(auth_user("admin")->roles->first()->name, $this->property['roles'])){
                return $this->renderWarningByRoleDenied($this->property['roles']);
            }
        }
        if (data_get($this->property, 'hidden') && $this->property['type'] != 'relation') {
            return Form::hidden($key, $value, $field_properties);
        }

        if ($this->hasComponent($this->property['type'], $key)) {
            return $this->makeComponent($key, $value, $locale, $field_properties);
        }
        if ($this->property['type'] == 'relation_image') {
            return AdminFormImageRelation::setProperty($this->property)->get($key, $value);
        }
        if ($this->property['type'] == 'select' && is_array($this->property['select_data'])) {
            return AdminFormSelect::withOptions($this->property['select_data'])->withName($key)->withSelected($value ?: '')->render();
        }
    }


    /**
     * @param $type
     * @param $key
     * @return bool
     */
    function hasComponent($type, $key)
    {
        if ($this->componentHasView($type, $key)) return true;
        if ($this->componentClassExist($type)) return true;
        if ($this->relationComponentClassExist($type)) return true;
        if ($this->relationStringComponentClassExist($type)) return true;
        return false;
    }


    /**
     * @param $key
     * @param $value
     * @param $locale
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function makeComponent($key, $value, $locale)
    {

        if ($this->componentClassExist($this->property['type'])) {
            $componentClassName = $this->resolveComponentClassNamespace($this->property['type']);
            return (new $componentClassName($this))->render($key, $value, $locale);
        }
        if ($this->relationComponentClassExist($this->property['type'])) {
            $componentClassName = $this->resolveRelationComponentClassNamespace($this->property['type']);
            return (new $componentClassName($this))->render($key, $value);
        }
        if ($this->relationStringComponentClassExist($this->property['type'])) {
            $componentClassName = $this->resolveRelationStringComponentClassNamespace($this->property['type']);
            return (new $componentClassName($this))->render($key, $value);
        }
        if ($this->componentHasView($this->property['type'], $key)) {
            return (new ViewComponent($this))->render($key, $value, $locale);
        }
        return false;
    }

    /**
     * @param $type
     * @return string
     */
    function resolveComponentClassNamespace($type)
    {
        return "App\FromSky\Admin\Decorators\AdminForm\\" . ucfirst(Str::camel($type)) . "Component";
    }

    /**
     * @param $type
     * @return string
     */
    function resolveRelationComponentClassNamespace($type)
    {
        return "App\FromSky\Admin\Decorators\AdminForm\\" . ucfirst(Str::camel($type)) . "SelectComponent";
    }

    /**
     * @param $type
     * @return string
     */
    function resolveRelationStringComponentClassNamespace($type)
    {
        return "App\FromSky\Admin\Decorators\AdminForm\\" . ucfirst(Str::camel($type)) . "Component";
    }

    /**
     * @param $type
     * @return bool
     */
    function componentClassExist($type)
    {
        return class_exists($this->resolveComponentClassNamespace($type));
    }

    /**
     * @param $type
     * @return bool
     */
    function relationComponentClassExist($type)
    {
        return class_exists($this->resolveRelationComponentClassNamespace($type));
    }

    /**
     * @param $type
     * @return bool
     */
    function relationStringComponentClassExist($type)
    {
        return class_exists($this->resolveRelationStringComponentClassNamespace($type));
    }


    /**
     * @param $type
     * @param $key
     * @return bool
     */
    function componentHasView($type, $key)
    {
        if (view()->exists('admin.inputs.' . $type)) return true;
        if (view()->exists('admin.inputs.' . $key)) return true;
        return false;
    }


    private function renderWarningByRoleDenied($allowed_roles){
        return '<div class="alert alert-warning" role="alert">
                        You do not have permissions to do this action!
                </div>';
    }
}