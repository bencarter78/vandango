<?php

namespace App\Mail\Nas;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TpNasVacancies extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    private $filepath;

    /**
     * Create a new message instance.
     *
     * @param $filepath
     */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Total People Vacancies - W/C ' . Carbon::today()->format('d/m/Y'))
                    ->view('emails.nas.exported-vacancies')
                    ->attach(storage_path($this->filepath));
    }
}
