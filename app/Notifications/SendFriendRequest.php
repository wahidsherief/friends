<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;


class SendFriendRequest extends Notification
{
    use Queueable;

    public $request_sender;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request_sender)
    {
        $this->request_sender = $request_sender;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray()
    {
        return [];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post'=>$this->request_sender
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'post'=>$this->request_sender
        ]);
    }
}
