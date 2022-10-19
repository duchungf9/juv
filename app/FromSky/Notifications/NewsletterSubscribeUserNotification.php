<?php

namespace App\FromSky\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Model\Newsletter;
use Illuminate\Support\HtmlString;

/**
 * Class NewsletterSubscriberUserNotification
 * @package App\FromSky\Notifications
 */
class NewsletterSubscribeUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     *
     * @param Newsletter $data
     */
    public function __construct(Newsletter $data)
    {
        //
        $this->data = $data;
        //$this->delay(now()->addMinute(1));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $subject = __('website.mail_message.subscribe_newsletter_subject') . ' - ' . config('fromSky.website.option.app.name');
        return (new MailMessage)
            ->subject($subject)
            ->greeting(__('website.mail_message.greeting'))
            ->line(__('website.mail_message.subscribe_newsletter_feedback'))
            ->when($this->data->coupon_code, function (MailMessage $mail) {
                return $mail
                    ->line(new HtmlString('<h2 style="text-align: center">'
                            . __('website.mail_message.subscribe_newsletter_coupon_message')
                            . '</h2>')
                    )
                    ->action($this->data->coupon_code, $this->data->coupon_url);
            })
            ->line('')
            ->salutation(trans('website.mail_message.firm'));
    }

}
