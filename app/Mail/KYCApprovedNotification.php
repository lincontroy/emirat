<?php

// app/Mail/KYCApprovedNotification.php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KYCApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your KYC Verification Has Been Approved')
                    ->markdown('emails.kyc-approved');
    }
}