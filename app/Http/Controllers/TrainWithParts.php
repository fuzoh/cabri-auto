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
                $partRecuperation = substr_count($r->participantRecuperation->names, "\n");
            }

            return [
                'station' => $r->ticket->transport_location->name,
                'total' => $r->ticket->totalPassengers() + $partRecuperation,
            ];
        })->groupBy('station')->map(function ($r) {
            return $r->reduce(function ($carry, $item) {
                return $carry + $item['total'];
            }, 0);
        });

        dd($totalReturnInTrain);

    }
}
