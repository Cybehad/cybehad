<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WeeklyDigestNotification extends Notification
{
    use Queueable;

    public $posts;

    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Your Weekly Tech Digest")
            ->markdown('emails.weekly-digest', [
                'posts' => $this->posts,
                'user' => $notifiable
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
