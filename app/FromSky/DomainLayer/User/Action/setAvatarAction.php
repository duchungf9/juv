<?php

namespace App\FromSky\DomainLayer\User\Action;


use App\Model\User;

class setAvatarAction
{
    protected User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function execute($avatar)
    {
        return $this->user->update(['avatar' => $avatar]);
    }
}