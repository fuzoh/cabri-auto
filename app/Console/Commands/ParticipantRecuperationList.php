<?php

namespace App\Console\Commands;

use App\Models\Registration;
use Illuminate\Console\Command;
use Rap2hpoutre\FastExcel\FastExcel;

class ParticipantRecuperationList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:participant-recuperation-list';

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
        $registrations = Registration::whereHas('participantRecuperation')->get();

        $part = $registrations->map(function ($r) {
            return [
                'id' => $r->id,
                'name' => $r->first_name.' '.$r->last_name,
                'enfants récupérés' => $r->participantRecuperation->names,
            ];
        });

        (new FastExcel($part))->export('parts.xlsx');
    }
}
