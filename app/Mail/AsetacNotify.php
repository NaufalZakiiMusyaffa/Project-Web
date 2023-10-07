<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AsetacNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $nama_kendaraan;
    public $nopol;
    public $karyawan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama_kendaraan, $nopol, $karyawan)
    {
        $this->nama_kendaraan = $nama_kendaraan;
        $this->nopol = $nopol;
        $this->karyawan = $karyawan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reminder Masa Berlaku STNK')
                    ->view('email.autocare_notify');
    }
}
