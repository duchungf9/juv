<?php


namespace App\FromSky\DomainLayer\Newsletter\Action;


use App\Model\Newsletter;
use Illuminate\Database\Eloquent\Model;

class AddNewsletterSubscriberAction
{

    private array $attributes = [];

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    function execute()
    {
        return Newsletter::create($this->attributes);
    }
}