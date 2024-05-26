<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Console\Command;

class AutoPaymentCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-payment-check';

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
        $this->info('Trying to find payments that match registrations...');
        // get all registrations without payments
        $registrations = Registration::whereNull('payment_confirmation_id')->get();

        // get all payments not linked to a registration
        $payments = Payment::doesntHave('registration')->get();

        foreach ($payments as $payment) {
            // Get payments with an id in the data_message
            preg_match('/- [a-z0-9]{4}-[a-z0-9]{4}/i', $payment->data_message, $match);
            if (isset($match[0])) {
                // Get only the uuid part
                $uuidPart = substr($match[0], 2, 9);
                // Find a registration with the same payment uuid part
                $registration = $registrations->first(function ($registration) use ($uuidPart) {
                    return $uuidPart === $registration->uuidPart();
                });
                // If there is a matching registration, link the payment to the registration
                if ($registration) {
                    $this->info('---- Found a registration for the payment ----');
                    $this->info($registration->email);
                    $this->info($registration->payment_id);
                    $this->info($registration->ticket->price());
                    $this->info('-- Payment --');
                    $this->info($payment->amount);
                    $this->info($payment->name);
                    $this->info($payment->data_message);
                    if ($registration->ticket->price() === $payment->amount) {
                        $registration->payment()->associate($payment);
                        $registration->save();
                    } else {
                        if ($this->confirm('Payment amount does not match, did you validate ?')) {
                            $registration->payment()->associate($payment);
                            $registration->save();
                        }
                    }
                } else {
                    $this->warn('No registration found for the payment');
                    $this->info($payment->name);
                    $this->info($payment->amount);
                    $this->info($payment->data_message);
                }
                $this->info('---------------------------------------------');
            }
        }
    }
}
