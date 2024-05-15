<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Inertia\Inertia;

class InformationsController extends Controller
{
    public function index()
    {
        // Number of registrations
        $registrations = Registration::count();
        // Number of registrations with payment validated
        $validated = Registration::whereNotNull('payment_confirmation_id')->count();
        // Sum of the due amounts
        $expected_amount = Registration::has('ticket')->with('ticket')->get()->sum(function ($registration) {
            return $registration->ticket->price();
        });
        // Sum of the payments received
        $received_amount = Registration::has('payment')->with('payment')->get()->sum(function ($registration) {
            return $registration->payment->amount;
        });
        return Inertia::render('Informations', [
            'registrations' => $registrations,
            'validated' => $validated,
            'expected_amount' => $expected_amount,
            'received_amount' => $received_amount,
        ]);
    }
}
