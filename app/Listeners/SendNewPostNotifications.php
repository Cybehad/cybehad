<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\User;
use App\Notifications\NewBlogPostNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewPostNotifications
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    public function handle(PostPublished $event)
    {
        // Get users who should receive notifications
        $users = User::where('receive_notifications', true)
            ->where(function($query) {
                $query->whereNull('last_notified_at')
                    ->orWhere('last_notified_at', '<', now()->subHours(24));
            })
            ->cursor();

        foreach ($users as $user) {
            $user->notify(new NewBlogPostNotification($event->post));
            $user->update(['last_notified_at' => now()]);
        }
    }
}
