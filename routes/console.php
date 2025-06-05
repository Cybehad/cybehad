<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Artisan::command('app:send-weekly-digest', function () {
//     $this->command()
//         ->weekly()
//         ->sundays()
//         ->at('09:00');
// })->purpose('Send weekly digest');
