<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Saloon\XmlWrangler\XmlReader;

class ImportPaymentConfirmations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-payment-confirmations';

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
        $bankXML = XmlReader::fromFile('payments.xml');
        //dd($payments->values());
        // Xpath to gat all payments amount from the bank xml
        $payments = $bankXML->value('Document.BkToCstmrStmt.Stmt.Ntry')->get();

        foreach ($payments as $payment) {
            try {
                if ($payment['CdtDbtInd'] === 'CRDT') { // Import only credits
                    $dBpayment = Payment::where('uetr', $payment['NtryDtls']['TxDtls']['Refs']['UETR'])->first();
                    if ($dBpayment) {
                        $this->info("Payment already exists {$dBpayment->uetr}");
                        continue;
                    }
                    DB::transaction(
                        function () use ($payment) {
                            Payment::create([
                                'payment_date' => $payment['ValDt']['Dt'],
                                'imported_at' => now(),
                                'data_message' => $payment['NtryDtls']['TxDtls']['RmtInf']['Ustrd'],
                                'name' => $payment['NtryDtls']['TxDtls']['RltdPties']['Dbtr']['Pty']['Nm'],
                                'iban' => $payment['NtryDtls']['TxDtls']['RltdPties']['DbtrAcct']['Id']['IBAN'],
                                'uetr' => $payment['NtryDtls']['TxDtls']['Refs']['UETR'],
                                'amount' => $payment['Amt'],
                            ]);
                        }
                    );
                }
            } catch (\Exception $e) {
                dump($e->getMessage());
                $this->warn('We have found a malformed entry');
                dump($payment['Amt'] ?? 'Amount not found');
                dump($payment['NtryDtls']['TxDtls']['RmtInf']['Ustrd'] ?? 'Message not found');
                dump($payment['NtryDtls']['TxDtls']['RltdPties']['Dbtr']['Pty']['Nm'] ?? 'Name not found');
                dump($payment['NtryDtls']['TxDtls']['RltdPties']['DbtrAcct']['Id']['IBAN'] ?? 'IBAN not found');
                dump($payment['NtryDtls']['TxDtls']['Refs']['UETR'] ?? 'UETR not found');
                if ($this->confirm('Do you want to add this entry ?')) {
                    $this->info('Adding entry');
                    Payment::create([
                        'payment_date' => $payment['ValDt']['Dt'],
                        'imported_at' => now(),
                        'name' => $payment['NtryDtls']['TxDtls']['RltdPties']['Dbtr']['Pty']['Nm'],
                        'iban' => $payment['NtryDtls']['TxDtls']['RltdPties']['DbtrAcct']['Id']['IBAN'],
                        'uetr' => $payment['NtryDtls']['TxDtls']['Refs']['UETR'],
                        'amount' => $payment['Amt'],
                    ]);
                } else {
                    $this->warn('Entry not added to DB');
                }
            }
        }
    }
}
