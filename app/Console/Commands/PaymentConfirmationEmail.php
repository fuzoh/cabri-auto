<?php

namespace App\Console\Commands;

use App\Mail\PaymentConfirmation;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PaymentConfirmationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment-confirmation-email';

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
        // get all registrations with an associated payment
        $registrations = Registration::whereNotNull('payment_confirmation_id')
            ->whereNull('payment_confirmation_email_sent')
            ->get();

        $bar = $this->output->createProgressBar(count($registrations));
        $bar->start();

        foreach ($registrations as $registration) {
            // Send the email
            try {
                Mail::to($registration->email)->send(new PaymentConfirmation($registration));
                $registration->payment_confirmation_email_sent = now();
                $registration->save();
            } catch (\Exception $e) {
                dump($registration);
                dump($e->getMessage());
            } finally {
                $bar->advance();
            }
        }

        $bar->finish();
    }
}
