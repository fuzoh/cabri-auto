<?php

namespace App\Console\Commands;

use App\Mail\AnniversaryJourneyConfirmation;
use App\Models\Registration;
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
        $registrations = Registration::whereNull('payment_email_sent')->get();

        $registrations->each(function ($r) {
            try {
                Mail::to($r->email)->send(new AnniversaryJourneyConfirmation($r));
                $r->update(['payment_email_sent' => now()]);
            } catch (\Exception $e) {
                $this->error("Error sending email to {$r->email}");
            }
        });
    }
}
