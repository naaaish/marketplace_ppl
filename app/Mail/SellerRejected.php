<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    // Terima data User saat dipanggil
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        // Subjek Email
        return new Envelope(
            subject: 'Status Pendaftaran Toko - Tuku',
        );
    }

    public function content(): Content
    {
        // Arahkan ke view email yang akan kita buat
        return new Content(
            view: 'emails.seller_rejected',
        );
    }
}