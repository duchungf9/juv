<?php

namespace App\View\Components\Admin\Lists\Table;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Index extends Component
{
    public $pages;
    public Collection $config;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $config,$pages)
    {

        $this->pages = $pages;
        $this->config = $config;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.lists.table.index');
    }
}
