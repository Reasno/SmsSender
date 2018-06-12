<?php

namespace Reasno\SmsSender\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel
{

    protected $sender;

    /**
     * Create a new SmsChannel instance.
     *
     * @param  SmsSender  $sender
     * @return void
     */
    public function __construct()
    {
        $this->sender = resolve('Reasno\SmsSender\Contracts\SmsSender');
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toNexmo($notifiable);
        $this->sender->send($notifiable->phone, $message->content)

        // Send notification to the $notifiable instance...
    }
}
