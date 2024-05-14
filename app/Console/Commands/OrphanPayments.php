<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;

class OrphanPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:orphan-payments';

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
        $payments = Payment::doesntHave('registration')->get();

        $this->info('Found '.$payments->count().' orphan payments');

        $this->table(
            ['id', 'name', 'amount', 'data_message'],
            $payments->map->only(['id', 'name', 'amount', 'data_message'])->toArray()
        );
    }
}
