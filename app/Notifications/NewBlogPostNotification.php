<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBlogPostNotification extends Notification
{
    use Queueable;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function withDelay($notifiable)
    {
        return [
            'mail' => now()->addMinutes(rand(0, 60)),
        ];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New Post: {$this->post->title}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("A new blog post has been published on our site:")
            ->action($this->post->title, route('posts.show', $this->post->id))
            ->line('Thank you for being a valued reader!');
    }

    public function toArray($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'title' => $this->post->title,
            'slug' => $this->post->slug,
            'message' => "New post published: {$this->post->title}"
        ];
    }
}
