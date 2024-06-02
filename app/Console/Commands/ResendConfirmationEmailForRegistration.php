<?php

namespace App\Console\Commands;

use App\Mail\PartRecuperationConfirmation;
use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ResendConfirmationEmailForRegistration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resend-confirmation-email-for-registration';

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
        $registrationId = $this->ask('Id of the registration to resend email');
        try {
            $registration = Registration::findOrFail($registrationId);
            if ($registration->participantRecuperation && ! $registration->ticket) {
                Mail::to($registration->email)->send(new PartRecuperationConfirmation($registration));
            } else {
                //dump($registration->ticket->transport_type);
                Mail::to($registration->email)->send(new RegistrationConfirmation($registration));
            }
        } catch (\Exception $e) {
            dump($registrationId);
            dump($e->getMessage());
        }
    }
}
