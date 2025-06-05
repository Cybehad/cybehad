<?php

namespace App\Providers;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        // Notification::macro('rateLimit', function ($limit = 10, $interval = 1) {
        //     $this->withDelay(now()->addMinutes(rand(0, $interval * 60)));

        //     return $this->through(
        //         fn($notifiable, $channel)
        //          => new \Illuminate\Notifications\Channels\ThrottledChannel($channel, $limit,1)
        //     );
        // });
    }
}
