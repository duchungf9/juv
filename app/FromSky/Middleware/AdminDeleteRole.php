<?php

namespace App\FromSky\Middleware;
/* TODO to be implemented */

class AdminDeleteRole extends AdminRole
{
    public function canDelete()
    {
        return $this->canAccess();
    }
}