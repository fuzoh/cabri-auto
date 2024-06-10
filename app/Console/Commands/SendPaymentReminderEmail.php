<?php

namespace App\Console\Commands;

use App\Mail\PaymentReminder;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPaymentReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-payment-reminder-email';

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
        // Get the registrations that have not yet paid and recieve the confirmation email from more than 10 days
        $registrations = Registration::whereNull('payment_confirmation_id')
            ->whereNull('cancelled_at')
            ->where('payment_email_sent', '<', now()->subDays(20))
            ->where(function ($query) {
                $query->whereDoesntHave('paymentReminders')
                    ->orWhereRelation('paymentReminders', 'sent_at', '<', now()->subDays(20));
            })
            ->get();

        $bar = $this->output->createProgressBar(count($registrations));
        $bar->start();

        foreach ($registrations as $registration) {
            // Send the email
            try {
                if ($registration->participantRecuperation && ! $registration->ticket) {
                    $this->info('part recuparation, no need to remind'.$registration->id);
                } else {
                    Mail::to($registration->email)->send(new PaymentReminder($registration));
                    $remind = new \App\Models\PaymentReminder(['sent_at' => now()]);
                    $registration->paymentReminders()->save($remind);
                }
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
