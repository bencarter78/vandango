<?php

namespace App\Mail\Apply;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExportedApplicantsReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $programme;

    /**
     * @var
     */
    public $filepath;

    /**
     * Create a new message instance.
     *
     * @param $programme
     * @param $filepath
     */
    public function __construct($programme, $filepath)
    {
        $this->programme = $programme;
        $this->filepath = $filepath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(ucwords($this->programme) . ' Exported Apply Applicants')
                    ->view('emails.apply.exported-applicants')
                    ->attach(storage_path($this->filepath));
    }
}
