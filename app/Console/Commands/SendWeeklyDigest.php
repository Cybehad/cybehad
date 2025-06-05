<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use App\Notifications\WeeklyDigestNotification;
use Illuminate\Console\Command;

class SendWeeklyDigest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-weekly-digest';

    protected $description = 'Send weekly digest emails';

    public function handle()
    {
        $posts = Post::whereBetween('published_at', [
            now()->subWeek(),
            now()
        ])->published()->get();

        User::where('receive_digest', true)
            ->chunk(200, function ($users) use ($posts) {
                foreach ($users as $user) {
                    $user->notify(new WeeklyDigestNotification($posts));
                }
            });
    }
}
