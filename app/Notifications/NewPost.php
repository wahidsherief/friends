<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewPost extends Notification
{
    use Queueable;

    public $new_post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newPost)
    {
        $this->new_post = $newPost;
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
    public function toArray($notifiable)
    {
        return $this->new_post->toArray();
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            $this->new_post->toArray()
        ]);
    }
}
