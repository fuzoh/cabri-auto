<?php

namespace App\Mail;

use App\Models\Enums\TransportType;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Sprain\SwissQrBill\DataGroup\Element\AdditionalInformation;
use Sprain\SwissQrBill\DataGroup\Element\CombinedAddress;
use Sprain\SwissQrBill\DataGroup\Element\CreditorInformation;
use Sprain\SwissQrBill\DataGroup\Element\PaymentAmountInformation;
use Sprain\SwissQrBill\DataGroup\Element\PaymentReference;
use Sprain\SwissQrBill\PaymentPart\Output\TcPdfOutput\TcPdfOutput;
use Sprain\SwissQrBill\QrBill;
use Sprain\SwissQrBill\Reference\QrPaymentReferenceGenerator;
use TCPDF;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Registration $registration,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Information pour le paiement - Journée anniversaire, 60 ans de la brigade des flambeaux de l'évangile",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.registration.initial_confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->genrateQrFacture(
                $this->billAmount(),
                $this->registration->payment_id,
                $this->registration->email,
                $this->registration->first_name,
                $this->registration->last_name
            ), "Facture.pdf")->withMime('application/pdf')
        ];
    }

    private function billAmount()
    {
        if ($this->registration->ticket->transport_type === TransportType::Car) {
            return $this->registration->ticket->totalJourneyPrice() + 10;
        } elseif ($this->registration->ticket->transport_type === TransportType::SpecialTrain) {
            return $this->registration->ticket->totalPrice();
        } elseif ($this->registration->ticket->transport_type === TransportType::Autonomous || $this->registration->ticket->transport_type === TransportType::LocalResident) {
            return $this->registration->ticket->totalJourneyPrice();
        }
        throw new \Exception("Unknown transport type");
    }

    private function genrateQrFacture($amount, $uuid, $email, $first_name, $last_name)
    {
        $qrBill = QrBill::create();
        $qrBill->setCreditor(
            CombinedAddress::create(
                "Le camp de brigade 2024",
                "Chemin de la Maraîche 10",
                "1802 Corseaux",
                "Suisse"
            )
        );
        $qrBill->setCreditorInformation(CreditorInformation::create("CH5380808005814755912"));
        $qrBill->setUltimateDebtor(
            CombinedAddress::create(
                $first_name . " " . $last_name,
                "",
                "",
                ""
            )
        );
        $qrBill->setPaymentAmountInformation(
            PaymentAmountInformation::create(
                "CHF",
                $amount
            )
        );
        $refNumber = QrPaymentReferenceGenerator::generate(
            null,
            $uuid
        );
        $qrBill->setPaymentReference(
            PaymentReference::create(
                PaymentReference::TYPE_QR,
                $refNumber
            )
        );
        $qrBill->setAdditionalInformation(
            AdditionalInformation::create(
                "Frais d'inscription journée anniversaire camp de brigade 2024"
            )
        );

        $tcPdf = new TCPDF('P', 'mm', 'A4', true, 'ISO-8859-1');
        $tcPdf->setPrintHeader(false);
        $tcPdf->setPrintFooter(false);
        $tcPdf->AddPage();
        $output = new TcPdfOutput($qrBill, 'en', $tcPdf);
        $output
            ->setPrintable(false)
            ->getPaymentPart();

        return $tcPdf->Output("Facture $first_name $last_name.pdf", 'E');
        //Storage::put("$uuid.pdf", $tcPdf->Output("$uuid.pdf", "S"));
    }
}
