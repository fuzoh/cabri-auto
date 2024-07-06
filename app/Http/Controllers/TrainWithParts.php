<?php

namespace App\Http\Controllers;

use App\Models\Enums\TransportType;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Builder;

class TrainWithParts extends Controller
{
    public function index()
    {
        $transports = Registration::with('participantRecuperation')
            ->whereHas('ticket', fn (Builder $builder) => $builder->where('transport_type', TransportType::SpecialTrain))
            ->get();

        $totalReturnInTrain = $transports->map(function (Registration $r) {
            $partRecuperation = 0;
            if ($r->participantRecuperation) {
                $partRecuperation = count(explode("\n", $r->participantRecuperation->names));
            }

            return [
                'station' => $r->ticket->transport_location->name,
                'total' => $r->ticket->totalPassengers(),
                'part_recup' => $partRecuperation,
            ];
        })->groupBy('station')->map(function ($r) {
            return $r->reduce(function ($carry, $item) {
                return $carry + $item['total'] + $item['part_recup'];
            }, 0);
        });

        dd($totalReturnInTrain);

    }
}
