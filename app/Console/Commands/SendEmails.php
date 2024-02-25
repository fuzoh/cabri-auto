<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Rap2hpoutre\FastExcel\FastExcel;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email send test';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $collection = (new FastExcel)->import('inscription.xlsx');
        dd($collection);
        $collection->each(function ($row) {
            echo $row['Adresse e-mail'];
        });
    }
}
