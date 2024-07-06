<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use TCPDF;

class LogisticInformations extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Registration $registration
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informations pratiques - journée anniverssaire - 60ème de la Brigade des Flambeaux',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.logisticInformations',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $transport = [];
        // TODO: plan check in, inscription générée, horaires correspondant
        if ($this->registration->ticket->transport_type === \App\Models\Enums\TransportType::SpecialTrain) {
            // Get right schedule
            $transport[1] = Attachment::fromStorage("horaires/{$this->registration->ticket->transport_location->value}.pdf")
                ->as("Horaires train {$this->registration->ticket->transport_location->value} - Rossignère.pdf")
                ->withMime('application/pdf');
        }

        return [
            Attachment::fromStorage('plan_check_in.pdf')
                ->as('Plan accès au check-in.pdf')
                ->withMime('application/pdf'),
            Attachment::fromData(fn () => $this->generateInscriptionPDF())
                ->as("Inscription {$this->registration->uuidPart()}.pdf")
                ->withMime('application/pdf'),
            ...$transport,
        ];
    }

    private function generateInscriptionPDF(): string
    {

        $html = \Illuminate\Support\Facades\View::make('pdf.inscription', [
            'registration' => $this->registration,
        ])->render();

        try {
            $tcPdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
            $tcPdf->setPrintHeader(false);
            $tcPdf->setPrintFooter(false);
            $tcPdf->setMargins(16, 16);
            $tcPdf->AddPage();
            $tcPdf->SetFont('helvetica', '', 12);

            $tcPdf->writeHTML($html, true, false, true, false, '');

            $tcPdf->write2DBarcode(
                $this->registration->payment_id,
                'QRCODE,M',
                114,
                194,
                80,
                80,
                [
                    'border' => 2,
                    'vpadding' => 'auto',
                    'hpadding' => 'auto',
                    'fgcolor' => [0, 0, 0],
                    'bgcolor' => false,
                    'module_width' => 1,
                    'module_height' => 1,
                ],
                'N');

            return $tcPdf->Output("Inscription {$this->registration->uuidPart()}.pdf", 'S');
        } catch (\Exception $e) {
            throw new \Exception('Failed to generate inscription PDF : '.$e->getMessage());
        }
    }
}
