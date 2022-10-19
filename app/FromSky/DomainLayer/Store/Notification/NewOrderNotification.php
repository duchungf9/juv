<?php

namespace App\FromSky\DomainLayer\Store\Notifications;

use App\Model\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Order
     */
    private Order $order;
    private bool $notify_to_admin; //

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, $notify_to_admin = true)
    {
        $this->order           = $order;
        $this->notify_to_admin = $notify_to_admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->order->newOrderEmailSubject())
            ->when($this->notify_to_admin, function (MailMessage $mail) {
                return $mail->cc(config('fromSky.website.option.app.email_order'));
            }
            )->view(['fromsky_store::emails.order-confirm-html', 'fromsky_store::emails.order-confirm-plain'], ['order' => $this->order]);
    }


}
