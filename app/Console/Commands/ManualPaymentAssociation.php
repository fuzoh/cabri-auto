<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Console\Command;

use function Psl\Str\to_int;

class ManualPaymentAssociation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:manual-payment-association';

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
        // get all payments not linked to a registration
        $payments = Payment::doesntHave('registration')->get();

        foreach ($payments as $payment) {
            $this->info('Is this payment valid ?');
            $this->info($payment->name);
            $this->info($payment->amount);
            $this->info($payment->data_message ?? 'No message');
            $this->info($payment->iban);
            $this->info($payment->uetr);
            $registrationId = to_int($this->ask('Id of the corresponding registration :'));
            $registration = Registration::find($registrationId);
            if ($registration) {
                $this->info('Found a registration for the payment');
                $this->info($registration->email);
                $this->info($registration->ticket->price());
                $this->info($payment->amount);
                $this->info('Payment :' . $payment->amount . $payment->name);
                if ($registration->ticket->price() === $payment->amount) {
                    if ($this->confirm('Do you want to associate this payment to this registration ?')) {
                        $registration->payment()->associate($payment);
                        $registration->save();
                    }
                } else {
                    if ($this->confirm('Payment amount does not match, did you validate ?')) {
                        $registration->payment()->associate($payment);
                        $registration->save();
                    }
                }
            } else {
                $this->error('No registration found with this id');
                if ($this->confirm('Remove this payment ?')) {
                    $payment->delete();
                }
            }
        }
    }
}
