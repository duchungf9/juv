<?php

namespace App\FromSky\Notifications;
interface SessionStore
{
    /**
     * Flash a message to the session.
     *
     * @param $name
     * @param $data
     */
    public function flash($name, $data);
}