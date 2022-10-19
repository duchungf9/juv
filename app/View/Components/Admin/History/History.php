<?php

namespace App\View\Components\Admin\History;

use Illuminate\View\Component;
use Spatie\Activitylog\Models\Activity;

class History extends Component
{
    public $model;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($model)
    {
        //
        $this->model =$model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $history = Activity::where("subject_type", get_class($this->model))->where("subject_id", $this->model->id)->orderBy("created_at","DESC")->get();
        return view('components.admin.history.history', compact('history'));
    }
}
