<?php

namespace App\FromSky\Website\Controllers;

use App\Http\Controllers\Controller;

use App\FromSky\DomainLayer\Contact\ContactViewModel;

class ContactController extends Controller
{
    public function __invoke()
    {
        return (new ContactViewModel())->handle('contacts');
    }
}