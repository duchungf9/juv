<?php

namespace App\View\Components\Website\Ui;


use Illuminate\Support\Str;
use Illuminate\View\Component;

/**
 * @property  model
 */
class Modal extends Component
{

    public $model;
    public string $session_tag='';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
        $this->session_tag= $this->getSessionTag();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view($this->resolveViewName());
    }

    public function show(){
        if(!$this->model->is_active) return false;
        if(!$this->model->is_one_time) {
            request()->session()->forget($this->session_tag);
            return true;
        }
        if (request()->session()->has($this->session_tag)) {
            return false;
        }
        session([$this->session_tag => true]);
        return true;
    }

    public function getModalId(){

        return Str::camel($this->model->code);
    }


    private function resolveViewName(){

        $modal_template = $this->model->code;
        if (view()->exists('components.website.ui.'.$modal_template)) {
            return 'components.website.ui.'.$modal_template;
        }
        else return 'components.website.ui.modal';
    }

    private function getSessionTag(){
        return env('APP_NAME','fromSky').'_'.$this->model->code;
    }
}
