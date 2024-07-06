<?php

namespace App\Console\Commands;

use App\Mail\LogisticInformations;
use App\Mail\PartRecuperationInformations;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendFinalInformations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-final-informations';

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
        // Get all the registrations that have received a confirmation email that doesnt have recieved this mail
        $registrations = Registration::with(['ticket', 'participantRecuperation'])
            ->whereNotNull('payment_email_sent')
            ->whereNull('cancelled_at')
            ->get()
            ->random(20);

        $bar = $this->output->createProgressBar(count($registrations));
        $bar->start();

        $registrations->each(function (Registration $registration) use ($bar) {
            try {
                if ($registration->participantRecuperation && ! $registration->ticket) {
                    // Only participant recuperation
                    Mail::to('bastien.nicoud@flambeaux.ch')->send(new PartRecuperationInformations($registration));
                } else {
                    // Participation to all journey
                    Mail::to('bastien.nicoud@flambeaux.ch')->send(new LogisticInformations($registration));
                }

                //$registration->logistic_information_sent = now();
                //$registration->save();
            } catch (\Exception $e) {
                dump($registration);
                dump($e);
            } finally {
                $bar->advance();
            }
        });

        $bar->finish();
    }
}
