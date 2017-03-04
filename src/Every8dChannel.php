<?php

namespace Recca0120\Every8d;

use Illuminate\Notifications\Notification;

class Every8dChannel
{
    /**
     * $client.
     *
     * @var \Recca0120\Every8d\Client
     */
    protected $client;

   /**
    * __construct.
    *
    * @param \Recca0120\Every8d\Client $client
    */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

   /**
    * Send the given notification.
    *
    * @param  mixed  $notifiable
    * @param  \Illuminate\Notifications\Notification  $notification
    *
    * @return \Recca0120\Every8d\Every8dMessage;
    */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('every8d')) {
            return;
        }

        $message = $notification->toEvery8d($notifiable);

        if (is_string($message)) {
            $message = new Every8dMessage($message);
        }

        return $this->client->send([
            'subject' => $message->subject,
            'to' => $to,
            'text' => trim($message->content),
        ]);
    }
}
