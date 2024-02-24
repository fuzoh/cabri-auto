<?php

namespace App\Console\Commands;

use App\Mail\AnniversaryInscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
    protected $description = 'Email send test';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::to('ludovic.richard@flambeaux.ch')->send(new AnniversaryInscription());
    }
}
