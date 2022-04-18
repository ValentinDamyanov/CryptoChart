<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class PriceAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $_price;

    /**
     * Create a new notification instance.
     *
     * @param $price
     */
    public function __construct($price)
    {
        $this->_price = $price;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $text = sprintf(Lang::get('common.price_alert'),$this->_price);
        return (new MailMessage)
            ->subject(Lang::get('common.price_alert_subject'))
            ->line($text);
    }

}
