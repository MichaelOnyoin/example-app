<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Support\DripEmailer;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending marketing emails to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info('Sending marketing emails to users...');
        $drip = new DripEmailer();
        $drip->send(User::find($this->argument('user')));
    }
}
