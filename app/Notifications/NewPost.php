<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPost extends Notification
{
    use Queueable;

    protected $new_post;

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
        return ['database'];
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

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'postTime' => \Carbon::now()
    //     ];
    // }
}
