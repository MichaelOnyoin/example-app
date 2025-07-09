<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Support\DripEmailer;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('mail:send {user}', function (DripEmailer $drip, string $user) {
    $this->info("Sending email to: {$user}!");
    $drip->send(User::find($user));
})->purpose('Send a marketing email to a user');