<?php

namespace App\Console\Commands;

use App\Mail\LogisticInformations;
use App\Mail\PartRecuperationInformations;
use App\Models\Enums\Location;
use App\Models\Enums\TransportType;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;

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
            ->whereNull('logistic_information_sent')
            ->whereNull('cancelled_at')
            //->whereHas('participantRecuperation')
            //->whereDoesntHave('ticket')
            //->whereRelation('ticket', 'transport_type', '=', TransportType::LocalResident)
            //->whereRelation('ticket', 'transport_location', '=', Location::Morges)
            ->get();
            //->random(5);

        $bar = $this->output->createProgressBar(count($registrations));
        $bar->start();

        $registrations->each(function (Registration $registration) use ($bar) {
            try {
                if ($registration->participantRecuperation && ! $registration->ticket) {
                    // Only participant recuperation
                    Mail::to($registration->email)->send(new PartRecuperationInformations($registration));
                } else {
                    // Participation to all journey
                    Mail::to($registration->email)->send(new LogisticInformations($registration));
                }

                $registration->logistic_information_sent = now();
                $registration->save();
            } catch (\Exception $e) {
                dump($registration);
                dump($e);
            } finally {
                $bar->advance();
                Sleep::usleep(200000);
            }
        });

        $bar->finish();
    }
}
