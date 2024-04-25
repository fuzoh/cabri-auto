<?php

namespace App\Console\Commands;

use App\Models\Registration;
use Illuminate\Console\Command;

class SendInscriptionConfirmationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-inscription-confirmation-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Final all registration that did not receive a confirmation email
        $registrations = Registration::where('payment_email_sent', null)->get();


        // Send the confirmation email

        // Add the send timestamp to the registration
    }
}
