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

    public $SendFriendRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($SendFriendRequest)
    {
        $this->SendFriendRequest = $SendFriendRequest;
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
                'post'=>$this->SendFriendRequest,
                'user'=>$notifiable
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
                'post'=>$this->SendFriendRequest,
                'user'=>$notifiable
        ]);
    }
}
