<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $verifikasi_kode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $verifikasi_kode)
    {
        $this->email = $email;
        $this->verifikasi_kode = $verifikasi_kode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')
                    ->view('email.forgot_password_notify');
    }
}
