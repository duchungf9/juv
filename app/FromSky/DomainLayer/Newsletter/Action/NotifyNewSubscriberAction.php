<?php


namespace App\FromSky\DomainLayer\Newsletter\Action;


use App\FromSky\Notifications\NewsletterSubscriberAdminNotification;
use App\FromSky\Notifications\NewsletterSubscribeUserNotification;
use App\Model\Newsletter;
use Illuminate\Support\Facades\Notification;

class NotifyNewSubscriberAction
{

    private Newsletter $newsletter;

    /**
     * NotifyNewSubscriberAction constructor.
     * @param Newsletter $newsletter
     */
    public function __construct(Newsletter $newsletter)
    {

        $this->newsletter = $newsletter;
    }

    /**
     * @return mixed
     */
    function execute()
    {
        Notification::route('mail', config('fromSky.website.option.app.email'))
            ->notify(new NewsletterSubscriberAdminNotification($this->newsletter));

        Notification::route('mail', $this->newsletter->email)
            ->notify(new NewsletterSubscribeUserNotification($this->newsletter));
    }
}