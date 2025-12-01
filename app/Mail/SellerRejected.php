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
    public $alasan; // Opsional: Kalau mau kasih alasan penolakan

    public function __construct(User $user, $alasan = 'Dokumen tidak lengkap atau tidak sesuai.')
    {
        $this->user = $user;
        $this->alasan = $alasan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mohon Maaf, Pendaftaran Toko Anda Ditolak',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.seller_rejected',
        );
    }
}