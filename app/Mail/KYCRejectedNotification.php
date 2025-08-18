<?php

// app/Mail/KYCRejectedNotification.php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KYCRejectedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reason;

    public function __construct(User $user, string $reason)
    {
        $this->user = $user;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('Your KYC Verification Requires Attention')
                    ->markdown('emails.kyc-rejected');
    }
}