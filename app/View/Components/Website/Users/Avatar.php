<?php

namespace App\View\Components\Website\Users;

use Illuminate\View\Component;

class Avatar extends Component
{
    public $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //get the  current user
        $this->user = auth_user();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.website.users.avatar');
    }

}