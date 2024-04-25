<?php

namespace App\Console\Commands;

use App\Mail\PartRecuperationConfirmation;
use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
        $registrations = Registration::whereNull('payment_email_sent')->get();

        // Send the confirmation email
        $registrations->each(function (Registration $registration) {
            // Send the email
            try {
                if ($registration->participantRecuperation && !$registration->ticket) {
                    Mail::to($registration->email)->send(new PartRecuperationConfirmation($registration));
                } else {
                    //dump($registration->ticket->transport_type);
                    Mail::to($registration->email)->send(new RegistrationConfirmation($registration));
                }

                // Mark the registration as having received the email
                //$registration->payment_email_sent = now();
                //$registration->save();
            } catch (\Exception $e) {
                dump($registration);
                dump($e);
            }

        });
    }
}
